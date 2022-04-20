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
    @parent
@endsection
@section('content')
<div class="row">
    <div class="col-3"></div>
    <div class="col-6 text-center py-3 border-bottom mb-4">
        <h2>Detail product</h2>
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
          <img class="shadow-lg p-3 mb-5 bg-body rounded" src="../../assets/client/images/{{$products->img}}" alt="">
      </div>
    </div>
    <div class="col-6">
      <div class="mt-5">
        <form action="{{route('user.addcart')}}" method="POST">
        @csrf
            <input type="hidden" name="idsp" value="{{$products->id}}">
            <div class="col py-3 d-flex align-item-center">
                <h2 class="mt-4">Name:</h2><p class="detail_text" name="name">{{$products->name}}</p>
            </div>
            <div class="col py-3 d-flex align-item-center">
                <h2>Price: </h2><p class="detail_text" name="price">{{number_format($products->price)}} VNĐ</p>
            </div>
            <!-- <div class="col py-3 d-flex align-item-center">
                <h2>Quantity: 
                <input class="minus is-form" type="button" value="-">
                <input aria-label="quantity" class="input-qty" max="10" min="1" name="quanty" type="number" value="1">
                <input class="plus is-form" type="button" value="+">
            </div> -->
            <div class="col py-3 d-flex align-items-center">
                <div class="py-3 border d-flex justify-content-center add_cart shadow p-3 mb-5">
                    <button type="submit">Add to cart</button>
                    <ion-icon name="cart-outline"></ion-icon>
                </div>
            </div>
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