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
    <div class="col-3"></div>
    <div class="col-6 text-center py-3 border-bottom mb-4">
        <h2>Personal Page</h2>
        @if (session('mess'))
            <div class="alert alert-success">
                {{ session('mess') }}
            </div>
        @endif
    </div>
    <div class="col-3"></div>
</div>
<div class="container">
  <div class="row border-0">
    <div class="col-6">
      <div class="item_detail">
      </div>
    </div>
    <div class="col-6">
      <div class="mt-5">
        <form action="{{route('user.addcart')}}" method="POST">
        @csrf
            
        </form>
      </div>
    </div>
  </div>
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