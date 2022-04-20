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
    <div class="col item_slidebar border-end  py-2 active">
        <a class="text-light" href="{{route('user.profile')}}">Profile</a>
    </div>
    <div class="col item_slidebar border-end py-2">
        <a class="text-light" href="{{route('user.favorite')}}">Favorite</a>
    </div>
    <div class="col item_slidebar  py-2">
        <a class="text-light" href="{{route('user.getorder')}}">Order</a>
    </div>
</div>
@endsection
@section('content')
<div class="row">
    <h2 class="text-center border-bottom">Edit Profile</h2>
    <div class="col-1"></div>
    <form action="{{route('user.edit')}}" method="post" enctype="multipart/form-data">
        <div class="col-10 text-center py-3 mb-4 d-flex">
        @if (session('mess'))
            <div class="alert alert-success">
                {{ session('mess') }}
            </div>
        @endif
            @csrf
            <div class="img" style="width: 50%;">
                <img id="avatar" class="shadow-lg p-3 mb-5 bg-body rounded" src="../../assets/client/images/{{$user->avt}}" alt="">
                <input type="file" name="avatar" id="form_input" class="form_input" onchange="choose(event)">
            </div>
            <div class="info" style="width: 50%;">
                <div class="name py-5 mt-4 mx-5" style="width: 100%;">
                    <span class="inf_item d-flex"><ion-icon class="inf_icon" name="person-outline"></ion-icon> Name: <p><input name="name" class="mx-1" type="text" value="{{old('name') ?? $user->name}}">
                    @error('name')
                        <span class="errors" style="color:red;">{{$message}}</span>
                    @enderror
                    </p></span>
                    
                </div>
                <div class="phone py-5 mt-4 mx-5" style="width: 100%;">
                    <span class="inf_item d-flex"><ion-icon class="inf_icon" name="phone-portrait-outline"></ion-icon> Phone: <p><input name="phone_num" type="text" value="{{old('phone_num') ?? $user->phone_num}}">
                    @error('phone_num')
                        <span class="errors" style="color:red;">{{$message}}</span>
                    @enderror
                    </p></span>
                </div>
                <div class="email py-5 mt-4 mx-5" style="width: 100%;">
                    <span class="inf_item d-flex"><ion-icon class="inf_icon" name="mail-outline"></ion-icon> Email: <p><input name="email" type="text" value="{{old('email') ?? $user->email}}">
                    @error('email')
                        <span class="errors" style="color:red;">{{$message}}</span>
                    @enderror
                    </p></span>
                </div>
                <div class="address py-5 mt-4 mx-5" style="width: 100%;">
                    <span class="inf_item d-flex"><ion-icon class="inf_icon" name="location-outline"></ion-icon> Address: <p><input name="address" type="text" value="{{old('address') ?? $user->address}}">
                    @error('address')
                        <span class="errors" style="color:red;">{{$message}}</span>
                    @enderror
                </p></span>
                </div>
                <button class="btn_savene" type="submit">Save</button>
            </div>
        </div>
    </form>
    <div class="col-1"></div>
</div>

<script type="text/javascript">
    function choose(event){
        var output = document.getElementById("avatar");
        var reader = new FileReader();
        reader.onload = function(){
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection