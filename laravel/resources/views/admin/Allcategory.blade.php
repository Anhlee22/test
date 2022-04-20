@extends('layouts.Admin')
@section('title')
    {{$title}}
@endsection
{{--@section('sidebar')
    @parent
    <h4>Trang chủ sidebar</h4>
@endsection--}}
@section('content')
<h3>Category List</h3>
<div class="container">          
  <table class="table">
    <thead>
      <tr>
        <th>STT</th>
        <th>Name</th>
        <th>Sửa</th>
        <th>Xóa</th>
      </tr>
    </thead>
    <tbody>
    @foreach($listCate as $key => $value)
      <tr>
        <td>{{$key+1}}</td>
        <td>{{$value->name}}</td>
        <td><a class="btn btn-warning btn-sm" href="{{route('admin.getedit_cate', ['id' => $value->id])}}">Sửa</a></td>
        <td><a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger btn-sm" href="{{route('admin.deletecate', ['id' => $value->id])}}">Xóa</a></td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>
@endsection