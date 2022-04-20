<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductsModel extends Model
{
    use HasFactory;
    public function addPro($data){
        DB::insert('INSERT INTO products (iddm, name, price, img) VALUE (?, ?, ?, ?)', $data);
    }

    public function getAllPro(){
        $pro = DB::table('products');
        $pro = $pro->paginate(4);
        return $pro;
    }

    public function getAllPro_index(){
        $pro = DB::table('products')->get();
        return $pro;
    }

    public function getpro_id($id){
        $pro = DB::select("SELECT * FROM products WHERE id = ?", [$id]);
        return $pro[0];
    }

    public function xoa($id){
        return DB::delete("DELETE FROM products WHERE id=?", [$id]);
    }

    public function edit($data, $id){
        $dataUp = array_merge($data, [$id]);
        return DB::update("UPDATE products SET name=?, price=?, iddm=? WHERE id = ?", $dataUp);
    }

    public function update_img($img, $id){
        DB::update("UPDATE products SET img=? WHERE id = ?", [$img, $id]);
    }
}
