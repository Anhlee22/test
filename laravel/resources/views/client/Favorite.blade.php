@extends('layouts.Client')
@section('title')
    {{$title}}
@endsection
@section('name')
    {{$name}}
@endsection
@section('status')
    @if($status == 'login')
        @include('client.blocks.logout')
    @else
        @include('client.blocks.login')
    @endif
@endsection
@section('sidebar')
<div class="row mb-3">
    <div class="col item_slidebar border-end  py-2">
        <a class="text-light" href="{{route('user.profile')}}">Profile</a>
    </div>
    <div class="col item_slidebar border-end py-2 active">
        <a class="text-light" href="{{route('user.favorite')}}">Favorite</a>
    </div>
    <div class="col item_slidebar  py-2">
        <a class="text-light" href="{{route('user.getorder')}}">Order</a>
    </div>
</div>
@endsection
@section('content')
<h3 class="text-center border-bottom">Favorite products</h3>
@if(empty($fa))
<h5>Null</h5>
@else
<div class="container">          
  <table class="table">
    <thead>
      <tr>
        <th>STT</th>
        <th>Image</th>
        <th>Name</th>
        <th>Price</th>
        <th>View</th>
      </tr>
    </thead>
    <tbody>
    @foreach($fa as $key => $value)
      <tr>
        <td>{{$key+1}}</td>
        <td><img src="../../assets/client/images/{{$value->img}}" alt="hihi" style="width: 120px;"></td>
        <td>{{$value->name}}</td>
        <td>{{number_format($value->price)}} VNĐ</td>
        <td><a class="btn btn-warning btn-sm" href="{{route('trangchu.detailproduct',['id'=>$value->id])}}">View</a></td>
      </tr>
      <input type="hidden" id="gia" value="{{$value->price}}">
    @endforeach
    </tbody>
  </table>
</div>
@endif
@endsection