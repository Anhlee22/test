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
    <h2 class="text-center border-bottom">Profile</h2>
    <div class="col-1"></div>
    <div class="col-10 text-center py-3 mb-4 d-flex">
        @if (session('mess'))
            <div class="alert alert-success">
                {{ session('mess') }}
            </div>
        @endif
        <div class="img" style="width: 50%;">
            <p class="btn_edit d-flex"><a href="{{route('user.editprofile')}}">Edit profile</a><ion-icon class="mx-1" style="color: white;" name="pencil-outline"></ion-icon></p>
            <img class="shadow-lg p-3 mb-5 bg-body rounded" src="../../assets/client/images/{{$user->avt}}" alt="">
            <!-- <input type="file" id="form_input" class="form_input"> -->
        </div>
        <div class="info" style="width: 50%;">
            <div class="name py-5 mt-4 mx-5" style="width: 100%;">
                <span class="inf_item d-flex"><ion-icon class="inf_icon" name="person-outline"></ion-icon> Name: <p>{{$user->name}}</p></span>
            </div>
            <div class="phone py-5 mt-4 mx-5" style="width: 100%;">
                <span class="inf_item d-flex"><ion-icon class="inf_icon" name="phone-portrait-outline"></ion-icon> Phone: <p>{{$user->phone_num}}</p></span>
            </div>
            <div class="email py-5 mt-4 mx-5" style="width: 100%;">
                <span class="inf_item d-flex"><ion-icon class="inf_icon" name="mail-outline"></ion-icon> Email: <p>{{$user->email}}</p></span>
            </div>
            <div class="address py-5 mt-4 mx-5" style="width: 100%;">
                <span class="inf_item d-flex"><ion-icon class="inf_icon" name="location-outline"></ion-icon> Address: <p>{{$user->address}}</p></span>
            </div>
        </div>
    </div>
    <div class="col-1"></div>
</div>
<script type="text/javascript">
    $('input.input-qty').each(function() {
        var $this = $(this),
            qty = $this.parent().find('.is-form'),
            min = Number($this.attr('min')),
            max = Number($this.attr('max'))
        if (min == 0) {
            var d = 0
        } else d = min
        $(qty).on('click', function() {
            if ($(this).hasClass('minus')) {
            if (d > min) d += -1
            } else if ($(this).hasClass('plus')) {
            var x = Number($this.val()) + 1
            if (x <= max) d += 1
            }
            $this.attr('value', d).val(d)
        })
    });
</script>
@endsection