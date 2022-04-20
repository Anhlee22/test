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
        <h2>Cart details</h2>
    </div>
    <div class="col-3"></div>
</div>
<div class="container">
    @if($detail == null)
    <h2>Cart is null</h2>
    @else
  <table class="table">
    <thead>
      <tr>
        <th>STT</th>
        <th>Image</th>
        <th>Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Save</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
    @php
        $total = 0;
        $num = 0;
    @endphp
    @foreach($detail as $key => $value)
      <form action="{{route('user.change')}}" method="post">
      @csrf
        <tr>
          <td>{{$key+1}}</td>
          <td><img src="../../assets/client/images/{{$value->img}}" alt="" style="width:120px;"></td>
          <td>{{$value->name}}</td>
          <td>{{number_format($value->price)}} đ</td>
          <td><input class="minus is-form" type="button" value="-"/>
              <input aria-label="quantity" class="input-qty" max="10" min="1" name="quanty" class="soluong" id="quanty" type="number" value="{{$value->quanty}}">
              <input class="plus is-form" type="button" value="+"/>
              <input type="hidden" name="idcart" value="{{$value->id_cart}}"/>
              <input type="hidden" name="idsp" value="{{$value->id_pro}}"/>
          </td>
          <td><button class="btn_save" type="submit"><ion-icon name="save-outline" style="font-size: 25px;"></ion-icon></button></td>
          <th><a href="{{route('user.xoasp_cart', ['id'=>$value->id])}}"><ion-icon name="close-outline" style="font-size: 24px; margin-left: 10px;"></ion-icon></a></th>
        </tr>
      </form>
        @php
            $total = $total + ($value->price * $value->quanty);
            $num++;
        @endphp
      @endforeach
    </tbody>
  </table>
  <div class="row">
      <div class="col-7"></div>
      <div class="col-4">
          Total: {{number_format($total)}} đ
          <!-- <p class="btn_order mt-3"><a href="">Order</a></p> -->
          <button type="button" class="btn_order mt-3" data-toggle="modal" data-target="#myModal">Order</button>
      </div>
  </div>
  @endif
</div>
<div class="container">
  <!-- Trigger the modal with a button -->

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog" style="width:100%;">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <form action="{{route('user.order')}}" method="POST">
        @csrf
            <div class="modal-header">
                <h4 class="modal-title">Invoice information</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body d-flex">
                <div class="inf">
                    <i>Recipient information</i>
                    <div class="name">
                        <input name="name" type="text" placeholder="Full name">
                        @error('name')
                            <span style="color:red;">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="phone">
                        <input name="phone" type="text" placeholder="Phone number">
                        @error('phone')
                            <span style="color:red;">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="address">
                        <input name="address" type="text" placeholder="Address">
                        @error('address')
                            <span style="color:red;">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="bill mx-5">
                    <i>Total</i>
                    <div class="total mt-3">
                        @if(isset($num))
                        <p>Number of items: {{$num}}</p>
                        @endif
                    </div>
                    <div class="total mt-3">
                        @if(isset($total))
                        <p>Total: {{number_format($total)}} đ</p>
                        <input type="hidden" name="total" value="{{$total}}">
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-default">Ok</button>
            </div>
        </form>
      </div>
      
    </div>
  </div>
  
</div>
<script type="text/javascript">
    $('input.input-qty').each(function() {
        // var quanty = document.getElementById()
        var $this = $(this),
            qty = $this.parent().find('.is-form'),
            min = Number($this.attr('min')),
            max = Number($this.attr('max'))
        if (min == 0) {
            var d = min
        } else {
          d = min + 6;
        }
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