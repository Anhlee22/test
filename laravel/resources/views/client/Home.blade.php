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
{{--@section('sidebar')
    @parent
    <h4>Trang chủ sidebar</h4>
@endsection--}}
@section('content')
    <h1>trang chủ</h1>
@endsection