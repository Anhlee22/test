@extends('layouts.Client')
@section('title')
    {{$title}}
@endsection
@section('sidebar')
@endsection
@section('content')
    <h3 class="text-center">Chỉnh sửa thông tin người dùng</h3>
        <form action="{{route('user.edit', ['id'=>$userDetail->id])}}" method="POST">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger text-center">
                    <p>{{$errorsM}}</p>
                </div>
            @endif
        <div class="form-group">
        <label for="fullname">Full name:</label>
            <input type="text" class="form-control" name="fullname" value="{{old('fullname') ?? $userDetail->name}}">
            @error('fullname')
                <span style="color:red;">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="fullname">User name:</label>
            <input type="text" class="form-control" name="username" value="{{old('username') ?? $userDetail->username}}">
            @error('username')
                <span style="color:red;">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="phone_num">Phone number:</label>
            <input type="text" class="form-control" name="phone_num" value="{{old('phone_num') ?? $userDetail->phone_num}}">
            @error('phone_num')
                <span style="color:red;">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" class="form-control" name="email" value="{{old('email') ?? $userDetail->email}}">
            @error('email')
                <span style="color:red;">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
        <label for="address">Address:</label>
        <input type="text" class="form-control" name="address" value="{{old('address') ?? $userDetail->address}}">
            @error('address')
                <span style="color:red;">{{$message}}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary my-3">Lưu</button>
        </form>
@endsection