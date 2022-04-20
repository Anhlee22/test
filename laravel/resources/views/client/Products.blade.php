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
<div class="container">
  <div class="row row-cols-2 row-cols-lg-4 g-2 g-lg-3 container_item">
  @foreach($products as $key => $value)
        <div class="col">
            <div class="p-3 border bg-light item shadow mb-5 bg-body rounded">
                <a href="{{route('trangchu.detailproduct',['id'=>$value->id])}}">
                <img src="../assets/client/images/{{$value->img}}" alt="">
                <div class="col text-center py-3">{{$value->name}}</div>
                </a>
                <div class="row text-center border-top inf">
                    <div class="col-4">
                        <ion-icon class="heart_null" id="{{'dislike'.$value->id}}" name="heart-outline" style="font-size: 20px; color: red;" onclick="like({{$value->id}})"></ion-icon>
                        <ion-icon class="heart_full" id="{{'like'.$value->id}}" name="heart" style="font-size: 20px; color: red;" onclick="dislike({{$value->id}})"></ion-icon>
                    </div>
                    <div class="col-2"></div>
                    <div class="col-6"><i>{{number_format($value->price)}} VNĐ</i></div>
                </div>
            </div>
        </div>
    @endforeach
  </div>
</div>
<script type="text/javascript">
    function like(id){
        $.ajax({
			type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "id": id
            },
			dataType: 'text',
			url: './../user/add_favorite' ,
			success: function(json){
				var sanpham = JSON.parse(json);
                console.log(sanpham);
                document.getElementById('dislike'+id).style.display="none";
                document.getElementById('like'+id).style.display="block";
			},
			error: function(error) {
				console.log(error);
			}
        });
    }

    function dislike(id){
        document.getElementById('dislike'+id).style.display="block";
        document.getElementById('like'+id).style.display="none";
        $.ajax({
			type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "id": id
            },
			dataType: 'text',
			url: './../user/remove_favorite' ,
			success: function(json){
				var dislike = JSON.parse(json);
                console.log(dislike);
			},
			error: function(error) {
				console.log(error);
			}
        });
    }

    $.ajax({
			type: "GET",
			dataType: 'text',
			url: './../user/get_favorite' ,
			success: function(json){
				var favorite = JSON.parse(json);
                console.log(favorite);
                for(var i = 0; i < favorite.length; i++){
                    document.getElementById('like'+favorite[i]['id_pro']).style.display="block";
                    document.getElementById('dislike'+favorite[i]['id_pro']).style.display="none";
                }
			},
			error: function(error) {
				console.log(error);
			}
        });
</script>
@endsection