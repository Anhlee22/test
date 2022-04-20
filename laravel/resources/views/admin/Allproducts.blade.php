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
        <th>Image</th>
        <th>Name</th>
        <th>Price</th>
        <th>Sửa</th>
        <th>Xóa</th>
      </tr>
    </thead>
    <tbody>
    @foreach($allproduct as $key => $value)
      <tr>
        <td>{{$key+1}}</td>
        <td><img src="../../assets/client/images/{{$value->img}}" alt="hihi" style="width: 120px;"></td>
        <td>{{$value->name}}</td>
        <td>{{number_format($value->price)}} VNĐ</td>
        <td><a class="btn btn-warning btn-sm" href="{{route('admin.getedit_pro', ['id' => $value->id])}}">Sửa</a></td>
        <td><a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger btn-sm" href="{{route('admin.deletepro',['id'=>$value->id])}}">Xóa</a></td>
      </tr>
      <input type="hidden" id="gia" value="{{$value->price}}">
    @endforeach
    </tbody>
  </table>
  {{$allproduct->links()}}
</div>
@endsection