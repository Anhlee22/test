<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\ProductsModel;

class AdminController extends Controller
{
    public function __construct(){
        $this->category = new CategoryModel();
        $this->product = new ProductsModel();
    }

    public function home(Request $request){
        $this->data['title'] = 'Trang chủ';
        $this->data['errorsM'] = 'Vui lòng kiểm tra lại dữ liệu';
        return view('admin.home', $this->data);
    }

    public function addcateView(){
        $this->data['title'] = 'thêm danh mục';
        $this->data['errorsM'] = 'Vui lòng kiểm tra lại dữ liệu';
        return view('admin.Addcategory', $this->data);
    }

    public function addcate(Request $request){
        $request->validate([
            'name' => 'required|unique:category',
        ]);

        $this->category->addCate($request->name);
        return redirect()->route('admin.allcate');
    }

    public function allcate(){
        $listCate = $this->category->getAllCate();
        $this->data['title'] = 'Tất cả danh mục';
        $this->data['listCate'] = $listCate;
        return view('admin.Allcategory', $this->data);
    }

    public function addproView(){
        $listCate = $this->category->getAllCate();
        $this->data['title'] = 'thêm sản phẩm';
        $this->data['listCate'] = $listCate;
        $this->data['errorsM'] = 'Vui lòng kiểm tra lại dữ liệu';
        return view('admin.Addproducts', $this->data);
    }

    public function allpro(){
        $allproduct = $this->product->getAllPro();
        $this->data['title'] = 'Tất cả sản phẩm';
        $path = storage_path('app/public/img/');
        $this->data['path'] = $path;
        $this->data['allproduct'] = $allproduct;
        return view('admin.Allproducts', $this->data);
    }

    public function addpro( Request $request){
        $request->validate([
            'name' => 'required|unique:products',
            'price' => 'required|integer',
            'img' => 'required'
        ]);

        $file = $request->img;
        $filename = $file->getClientOriginalname();
        // $renameimg = $filename;
        // if(file_exists(public_path('assets/client/images').$filename)){
        //     $str = explode(".",$filename);
        //     $renameimg = $str[0].round(microtime(true)).".".$str[1];
        // }
        $file->move(public_path('assets/client/images'), $filename);
        $data = [
            $request->category,
            $request->name,
            $request->price,
            $filename
        ];
        // dd($data);
        $this->product->addPro($data);
        return redirect()->route('admin.allpro');
    }

    public function getedit_cate($id=0){
        $this->data['title'] = 'Sửa danh mục';
        $this->data['errorsM'] = 'Vui lòng kiểm tra lại dữ liệu';
        $cate = $this->category->getCate_id($id);
        $this->data['cate'] = $cate;
        return view('admin.Editcategory', $this->data);
    }

    public function postedit_cate(Request $request, $id=0){
        $request->validate([
            'name' => 'required|unique:category,name,'.$id
        ]);
        $this->category->edit($request->name, $id);
        return redirect()->route('admin.allcate');
    }

    public function deletecate($id){
        if(!empty($id)){
            $cate = $this->category->getCate_id($id);
            if(!empty($cate)){
                $this->category->xoa($id);
                return redirect()->route('admin.allcate');
            }
        }else{
            return redirect()->route('admin.allcate');
        }
    }

    public function deletepro($id){
        if(!empty($id)){
            $this->product->xoa($id);
            return redirect()->route('admin.allpro');
        }else{
            return redirect()->route('admin.allpro');
        }
    }

    public function getedit_pro($id){
        $listCate = $this->category->getAllCate();
        $this->data['listCate'] = $listCate;
        $this->data['title'] = 'Sửa sản phẩm';
        $this->data['errorsM'] = 'Vui lòng kiểm tra lại dữ liệu';
        $pro = $this->product->getpro_id($id);
        $this->data['pro'] = $pro;
        return view('admin.Editproduct', $this->data);
    }

    public function postedit_pro(Request $request, $id){
        $request->validate([
            'name' => 'required|unique:products,name,'.$id,
            'price' => 'required|integer'
        ]);

        $data = [
            $request->name,
            $request->price,
            $request->category
        ];

        $this->product->edit($data, $id);

        if(!empty($request->img)){
            $file = $request->img;
            $filename = $file->getClientOriginalname();
            $file->move(public_path('assets/client/images'), $filename);
            unlink(public_path('assets/client/images/').$request->ole_img);
            $this->product->update_img($filename, $id);
        }
        return redirect()->route('admin.allpro');
    }
}
