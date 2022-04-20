@extends('layouts.Admin')
@section('title')
    {{$title}}
@endsection
@section('sidebar')
    @parent
@endsection
@section('content')
<div class="container position-relative">
            <div class="row py-5">
                <div class="col-3"></div>
                    <div class="col py-5 shadow-lg pb-5 rounded login position-relative">
                    <h3 class="text-center">Add new Category</h3>
                        <form action="{{route('admin.addcate')}}" method="POST">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger text-center">
                                    <p>{{$errorsM}}</p>
                                </div>
                            @endif
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" name="name" value="{{old('name')}}">
                            @error('name')
                                <span style="color:red;">{{$message}}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary position-absolute top-100 start-50 translate-middle">Save</button>
                        </form>
                    </div>
                <div class="col-3"></div>
            </div>
        </div>
@endsection