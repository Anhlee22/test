<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CategoryModel extends Model
{
    use HasFactory;

    public function addCate($name){
        DB::insert('INSERT INTO category (name) VALUE (?)', [$name]);
    }

    public function getAllCate(){
        $cate = DB::select('SELECT * FROM category');
        return $cate;
    }

    public function getCate_id($id){
        $cate = DB::select("SELECT * FROM category WHERE id = ?", [$id]);
        return $cate[0];
    }

    public function edit($name, $id){
        return DB::update("UPDATE category SET name=? WHERE id = ?", [$name, $id]);
    }

    public function xoa($id){
        return DB::delete("DELETE FROM category WHERE id=?", [$id]);
    }
}
