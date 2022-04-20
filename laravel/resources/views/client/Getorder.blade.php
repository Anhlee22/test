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
<h3 class="text-center border-bottom">Order</h3>
@if(empty($order))
<h5>Null</h5>
@else
<div class="container">     
  <table class="table">
    <thead>
      <tr>
        <th>STT</th>
        <th>ID</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Total</th>
        <th>Detail</th>
      </tr>
    </thead>
    <tbody>
    @foreach($order as $key => $value)
      <tr>
        <td>{{$key+1}}</td>
        <td>{{$value->id}}</td>
        <td>{{$value->name}}</td>
        <td>{{$value->phone}}</td>
        <td>{{$value->address}}</td>
        <td>{{number_format($value->total)}} VNĐ</td>
        <td><a class="btn btn-warning btn-sm" href="{{route('trangchu.detailproduct',['id'=>$value->id])}}">Detail</a></td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>
@endif
@endsection