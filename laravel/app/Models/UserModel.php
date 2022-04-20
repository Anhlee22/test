<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserModel extends Model
{
    use HasFactory;

    public function getAllUser(){
        $user = DB::select('SELECT * FROM users');
        return $user;
    }

    public function addUser($data){
        DB::insert('INSERT INTO users (name, username, password, phone_num, email, address, role, avt) VALUE (?, ?, ?, ?, ?, ?, 0, "macdinh.png")', $data);
        $id = DB::select('SELECT id FROM users ORDER BY id DESC LIMIT 1');
        $max = $id[0]->id;
        DB::insert('INSERT INTO cart (iduser) VALUE (?)', [$max]);
    }

    public function getDetail($id){
        $user = DB::select("SELECT * FROM users WHERE id = ?", [$id]);
        return $user;
    }

    public function edit($data, $id){
        $dataUp = array_merge($data, [$id]);
        return DB::update("UPDATE users SET name=?, username=?, phone_num=?, email=?, address=? WHERE id = ?", $dataUp);
    }

    public function xoaus($idus){
        return DB::delete("DELETE FROM users WHERE id=?", [$idus]);
    }

    public function checkrole($username){
        $role = DB::select("SELECT role FROM users WHERE username = ?", [$username]);
        return $role;
    }

    public function add_favorite($id_pro, $id_user){
        DB::table('favorite')->insert(['id_pro' => $id_pro, 'id_user' => $id_user]);
    }

    public function get_favorite($id_user){
        return DB::table('favorite')->where('id_user', $id_user)->get();
    }

    public function remove_favorite($id_pro, $id_user){
        DB::table('favorite')->where('id_user', $id_user)->where('id_pro', $id_pro)->delete();
    }

    public function getfavorite($id_user){
        return DB::select("SELECT p.*, f.* FROM products as p JOIN favorite as f on p.id = f.id_pro WHERE f.id_user = ? ", [$id_user]);
    }

    public function editprofile($data, $id) {
        $dataUp = array_merge($data, [$id]);
        return DB::update("UPDATE users SET name=?, phone_num=?, email=?, address=? WHERE id = ?", $dataUp);
    }

    public function updateavt($img, $id) {
        return DB::update("UPDATE users SET avt=? WHERE id = ?", [$img, $id]);
    }

    public function order($id, $total, $name, $phone, $address){
        DB::table('userorder')->insert(['id_user' => $id, 'total' => $total, 'name'=>$name, 'phone' => $phone, 'address' => $address]);
        $id = DB::select('SELECT id FROM userorder ORDER BY id DESC LIMIT 1');
        $max = $id[0]->id;
        return $max;
    }

    public function detailorder($idorder, $idpro, $price, $quanti, $img, $name){
        DB::table('detail_order')->insert(['id_order' => $idorder, 'id_pro' => $idpro, 'price'=>$price, 'quantity' => $quanti, 'img'=>$img, 'name'=>$name]);
    }

    public function deletecart($id){
        DB::table('cartdetail')->where('id_detail', $id)->delete();
    }

    public function getorder($id){
        return DB::table('userorder')->where('id_user', $id)->get();
    }

    public function getdetails($id){
        return DB::table('detail_order')->where('id_order', $id)->get();
    }
}
