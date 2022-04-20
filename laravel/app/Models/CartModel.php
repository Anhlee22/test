<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CartModel extends Model
{
    use HasFactory;

    public function getid_cart($idus){
        $id = DB::select("SELECT id FROM cart WHERE iduser = ?", [$idus]);
        $idcart = $id[0]->id;
        return $idcart;

    }

    public function getdetail($id){
        $detail = DB::select("SELECT sp.*, c.* FROM products as sp join cartdetail as c on sp.id = c.id_pro WHERE id_cart = ?", [$id]);
        return $detail;
    }
    
    public function addcart($idcart, $idsp, $sl){
        $check = DB::select("SELECT * FROM cartdetail WHERE id_pro = ?", [$idsp]);
        if(!empty($check)){
            $qty = $check[0]->quanty;
            $sl = $sl + $qty;
            DB::update("UPDATE cartdetail SET quanty=? WHERE id_pro = ?", [$sl, $idsp]);
        }else{
           DB::insert('INSERT INTO cartdetail (id_cart, id_pro, quanty) VALUE (?, ?, ?)', [$idcart, $idsp, $sl]);
        }
    }

    public function get_quanty_pro($idcart){
        $sl = DB::table('cartdetail')->where('id_cart', $idcart)->count();
        return $sl;
    }

    public function del_cart($id){
        return DB::delete("DELETE FROM cartdetail WHERE id_pro=?", [$id]);
    }

    public function update_sl($sl, $id, $idcart){
        DB::update("UPDATE cartdetail SET quanty=? WHERE id_pro = ? and id_cart = ?", [$sl, $id, $idcart]);
    }
}
