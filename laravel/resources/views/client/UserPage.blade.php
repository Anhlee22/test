@extends('layouts.Client')
@section('title')
    {{$title}}
@endsection
{{--@section('sidebar')
    @parent
    <h4>Trang chủ sidebar</h4>
@endsection--}}
@section('content')
<h3>Danh sách người dùng</h3>
<div class="container">          
  <table class="table">
    <thead>
      <tr>
        <th>STT</th>
        <th>Họ và tên</th>
        <th>Tài khoản</th>
        <th>Email</th>
        <th>Số điện thoại</th>
        <th>Địa chỉ</th>
        <th>Sửa</th>
        <th>Xóa</th>
      </tr>
    </thead>
    <tbody>
    @foreach($listUser as $key => $value)
      <tr>
        <td>{{$key+1}}</td>
        <td>{{$value->name}}</td>
        <td>{{$value->username}}</td>
        <td>{{$value->email}}</td>
        <td>{{$value->phone_num}}</td>
        <td>{{$value->address}}</td>
        <td><a class="btn btn-warning btn-sm" href="{{route('user.getEdit', ['id' => $value->id]) }}">Sửa</a></td>
        <td><a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger btn-sm" href="{{route('user.delete', ['id' => $value->id]) }}">Xóa</a></td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>
@endsection