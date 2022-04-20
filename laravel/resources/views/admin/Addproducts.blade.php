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
                    <h3 class="text-center">Add new product</h3>
                        <form action="{{route('admin.addproduct')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger text-center">
                                    <p>{{$errorsM}}</p>
                                </div>
                            @endif
                        <div class="form-group">
                            <label for="name">Category:</label>
                            <select name="category" class="form-select form-select-lg mb-3" aria-label="Default select example">
                            @foreach($listCate as $key => $value)
                                <option selected value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                            </select>
                            @error('category')
                                <span style="color:red;">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" name="name" value="{{old('name')}}">
                            @error('name')
                                <span style="color:red;">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="text" class="form-control" name="price" value="{{old('price')}}">
                            @error('price')
                                <span style="color:red;">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="img">Image:</label>
                            <input type="file" class="form-control" name="img" value="{{old('img')}}">
                            @error('img')
                                <span style="color:red;">{{$message}}</span>
                            @enderror
                        </div>
                        <!-- <div class="form-group">
                            <label for="mota">Description Image:</label>
                            <input type="file" multiple="multiple" class="form-control" id="mota[]" name="mota[]" value="{{old('img')}}">
                            @error('img')
                                <span style="color:red;">{{$message}}</span>
                            @enderror
                        </div> -->
                        <button type="submit" class="btn btn-primary position-absolute top-100 start-50 translate-middle">Save</button>
                        </form>
                    </div>
                <div class="col-3"></div>
            </div>
        </div>
@endsection