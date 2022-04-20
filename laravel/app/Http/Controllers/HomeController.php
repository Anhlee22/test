<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\ProductsModel;
use App\Models\CartModel;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public $data = [];
    private $user;
    private $cart;

    public function __construct(){
        $this->user = new UserModel();
        $this->products = new ProductsModel();
        $this->cart = new CartModel();
        $login = "";
        // if(Auth::check()){
        //     $this->data['soluong'] = "10";
        // }
    }

    public function homePage(Request $request){
        if(Auth::check()){
            $this->data['status'] = "login";
            $this->data['name'] = Auth::user()->name;
        }else{
            $this->data['name'] = "";
            $this->data['status'] = "logout";
        }
        $this->data['title'] = 'trang chủ';
        $this->data['errorsM'] = 'Vui lòng kiểm tra lại dữ liệu';
        return view('client.home', $this->data);
    }

    public function loginView(){
        $this->data['errorsM'] = 'Vui lòng kiểm tra lại dữ liệu';
        return view('client.Login', $this->data);
    }

    public function login(Request $request){

        $rule = [
            'username' => 'required',
            'pwd' => 'required|integer'
        ];

        $message = [
            'username.required' => 'Vui lòng nhập Username',
            'pwd.required' => 'Vui lòng nhập Password',
            'pwd.integer' => 'Password không hợp lệ',
        ];
        
        $request->validate($rule, $message);
        
        $login = Auth::attempt(['username' => $request->username, 'password' => $request->pwd]);
        $role = $this->user->checkrole($request->username, $request->pwd);
        // dd($role[0]->role);
        if($login){
            if($role[0]->role === 1){
                return redirect()->route('admin.home');
            }else{
                return redirect()->route('trangchu.homePage');
            }
        }
        return redirect()->route('trangchu.loginView');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('trangchu.homePage');
    }

    public function registerView(){
        $this->data['errorsM'] = 'Vui lòng kiểm tra lại dữ liệu';
        return view('client.Register', $this->data);
    }

    public function register(Request $request){
        $request->validate([
            'fullname' => 'required',
            'phone_num' => 'required|min:10|unique:users',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'address' => 'required',
            'pass' => 'required',
        ], [
            'fullname.required' => 'Vui lòng nhập họ và tên',
            'username.required' => 'Vui lòng nhập tên đăng nhập',
            'username.unique' => 'Tên đăng nhập đã tồn tại',
            'phone_num.required' => 'Vui lòng nhập số điện thoại',
            'phone_num.unique' => 'Số điện thoại đã tồn tại',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'address.required' => 'Vui lòng nhập địa chỉ',
            'pass.required' => 'Vui lòng nhập Password',
        ]);

        $data = [
            $request->fullname,
            $request->username,
            bcrypt($request->pass),
            $request->phone_num,
            $request->email,
            $request->address,
            
        ];

        $this->user->addUser($data);
        return redirect()->route('trangchu.loginView');
    }

    public function user(){
        $user = new UserModel();
        $listUser = $this->user->getAllUser();
        $this->data['title'] = 'Trang cá nhân';
        $this->data['listUser'] = $listUser;
        return view('client.UserPage', $this->data);
    }

    public function ProView(Request $request){
        $pro = $this->products->getAllPro_index();
        if(Auth::check()){
            $this->data['status'] = "login";
            $this->data['name'] = Auth::user()->name;
        }else{
            $this->data['name'] = "";
            $this->data['status'] = "logout";
        }
        $this->data['title'] = 'Sản phẩm';
        $this->data['products'] = $pro;
        $this->data['errorsM'] = 'Vui lòng kiểm tra lại dữ liệu';
        return view('client.Products', $this->data);
    }

    public function getAdd(Request $request){
        $this->data['title'] = 'Thêm sản phẩm';
        return view('client.add', $this->data);
    }

    public function getEdit($id = 0){
        $this->data['title'] = 'Cập nhật người dùng';
        $this->data['errorsM'] = 'Vui lòng kiểm tra lại dữ liệu';
        if(!empty($id)){
            $userDetail = $this->user->getDetail($id);
            if(!empty($userDetail)){
                $userDetail = $userDetail[0];
            }
        }else{
            return redirect()->router('user.alluser');
        }
        $this->data['userDetail'] = $userDetail;
        return view('client.Edit', $this->data);
    }

    public function edit(Request $request, $id=0){
        $request->validate([
            'fullname' => 'required',
            'phone_num' => 'required|min:10|unique:user,phone_num,'.$id,
            'username' => 'required|unique:user,username,'.$id,
            'email' => 'required|email|unique:user,email,'.$id,
            'address' => 'required',
        ], [
            'fullname.required' => 'Vui lòng nhập họ và tên',
            'username.required' => 'Vui lòng nhập tên đăng nhập',
            'username.unique' => 'Username đã tồn tại',
            'phone_num.required' => 'Vui lòng nhập số điện thoại',
            'phone_num.unique' => 'Số điện thoại đã tồn tại',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'address.required' => 'Vui lòng nhập địa chỉ',
        ]);

        $data = [
            $request->fullname,
            $request->username,
            $request->phone_num,
            $request->email,
            $request->address,
        ];
        $this->user->edit($data, $id);
        return redirect()->route('user.alluser');
    }

    public function delete($id){
        if(!empty($id)){
            $userDetail = $this->user->getDetail($id);
            if(!empty($userDetail)){
                $this->user->xoaus($id);
                return redirect()->route('user.alluser');
            }
        }else{
            return redirect()->route('user.alluser');
        }
    }

    public function detailproduct($id){
        if(Auth::check()){
            $this->data['name'] = Auth::user()->name;
            $this->data['status'] = "login";
        }else{
            $this->data['name'] = "";
            $this->data['status'] = "logout";
        }
        $this->data['title'] = 'Chi tiết sản phẩm';
        $this->data['errorsM'] = 'Vui lòng kiểm tra lại dữ liệu';
        $pro = $this->products->getpro_id($id);
        $this->data['products'] = $pro;
        return view('client.Detailproduct', $this->data);
    }

    public function getCart(){
        if(Auth::check()){
            $this->data['name'] = Auth::user()->name;
            $this->data['status'] = "login";
        }else{
            $this->data['name'] = "";
            $this->data['status'] = "logout";
        }
        $this->data['title'] = 'Giỏ hàng';
        $this->data['errorsM'] = 'Vui lòng kiểm tra lại dữ liệu';
        $idcart = $this->cart->getid_cart(Auth::user()->id);
        $detail = $this->cart->getdetail($idcart);
        $this->data['detail'] = $detail;
        // dd($detail);
        return view('client.Cartview', $this->data);
    }

    public function addcart(Request $request){
        $id = Auth::user()->id;
        $idcart = $this->cart->getid_cart($id);
        $add = $this->cart->addcart($idcart, $request->idsp, 1);
        return redirect()->route('trangchu.detailproduct',['id'=>$request->idsp])->with('mess','Thêm sản phẩm vào giỏ hàng thành công!');
    }

    public function change(Request $request){
        $sl = $request->quanty;
        $idsp = $request->idsp;
        $cart = $request->idcart;
        $del = $this->cart->update_sl($sl, $idsp, $cart);
        return redirect()->route('user.getCart');
    }

    public function xoasp_cart($id){
        $del = $this->cart->del_cart($id);
        return redirect()->route('user.getCart');
    }

    public function add_favorite(Request $request){
        $id = $request->id;
        $this->user->add_favorite($id, Auth::user()->id);
        return response()->json("qua rồi nha");
    }

    public function get_favorite(){
        $favorite = $this->user->get_favorite(Auth::user()->id);
        return response()->json($favorite);
    }

    public function remove_favorite(Request $request){
        $id = $request->id;
        $this->user->remove_favorite($id, Auth::user()->id);
        return response()->json("xóa rồi nha");
    }

    public function personalpage(){
        if(Auth::check()){
            $this->data['name'] = Auth::user()->name;
            $this->data['status'] = "login";
        }
        $this->data['title'] = 'Trang cá nhân';
        $this->data['errorsM'] = 'Vui lòng kiểm tra lại dữ liệu';
        return view('client.Personal', $this->data);
    }

    public function profile(){
        if(Auth::check()){
            $this->data['name'] = Auth::user()->name;
            $this->data['status'] = "login";
        }
        $this->data['title'] = 'Trang cá nhân';
        $this->data['errorsM'] = 'Vui lòng kiểm tra lại dữ liệu';
        $user = $this->user->getDetail(Auth::user()->id);
        $this->data['user'] = $user[0];
        return view('client.Profile', $this->data);
    }

    public function favorite(){
        if(Auth::check()){
            $this->data['name'] = Auth::user()->name;
            $this->data['status'] = "login";
        }
        $this->data['title'] = 'Favorite Products';
        $this->data['errorsM'] = 'Vui lòng kiểm tra lại dữ liệu';
        $fa = $this->user->getfavorite(Auth::user()->id);
        $this->data['fa'] = $fa;
        return view('client.Favorite', $this->data);
    }

    public function editpro(){
        if(Auth::check()){
            $this->data['name'] = Auth::user()->name;
            $this->data['status'] = "login";
        }
        $this->data['title'] = 'Chỉnh sửa thông tin';
        $user = $this->user->getDetail(Auth::user()->id);
        $this->data['user'] = $user[0];
        return view('client.EditProfile', $this->data);
    }

    public function editprofile(Request $request){
        $id = Auth::user()->id;
        $request->validate([
            'name' => 'required',
            'phone_num' => 'required|min:10|unique:users,phone_num,'.$id,
            'email' => 'required|email|unique:users,email,'.$id,
            'address' => 'required',
        ]);

        $data = [
            $request->name,
            $request->phone_num,
            $request->email,
            $request->address,
        ];

        if(!empty($request->avatar)){
            $file = $request->avatar;
            $filename = $file->getClientOriginalname();
            $file->move(public_path('assets/client/images'), $filename);
            $this->user->updateavt($filename, $id);
        }

        $this->user->editprofile($data, $id);
        return redirect()->route('user.profile');
    }

    public function order(Request $request){
        $id = Auth::user()->id;
        $request->validate([
            'name' => 'required',
            'phone' => 'required|min:10',
            'address' => 'required',
        ]);

        $total = $request->total;
        $name = $request->name;
        $phone = $request->phone;
        $address = $request->address;
        
        $order = $this->user->order($id, $total, $name, $phone, $address);

        $idcart = $this->cart->getid_cart(Auth::user()->id);
        $detail = $this->cart->getdetail($idcart);
        foreach ($detail as $key => $value){
            $idpro = $value->id_pro;
            $price = $value->price;
            $quanty = $value->quanty;
            $img = $value->img;
            $name = $value->name;
            $iddetail = $value->id_detail;
            $this->user->detailorder($order, $idpro, $price, $quanty, $img, $name);
            $this->user->deletecart($iddetail);
        }

        return redirect()->route('user.getCart');
    }

    public function getorder(){
        if(Auth::check()){
            $this->data['name'] = Auth::user()->name;
            $this->data['status'] = "login";
        }
        $this->data['title'] = 'Order';
        $this->data['errorsM'] = 'Vui lòng kiểm tra lại dữ liệu';
        $idus = Auth::user()->id;
        $order = $this->user->getorder($idus);
        $this->data['order'] = $order;
        return view('client.Getorder', $this->data);
    }
}
