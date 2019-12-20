@extends('layouts.layout')
@section('title', '商品展示')
@section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>产品详情</h1>
      </div>
     </header>
     <div id="sliderA" class="slider">
	 @foreach($ginfo->g_imgs as $v)
      <img src="{{env('UPLOAD_URL')}}{{$v}}" width="100px" height="100px" />
      @endforeach
     </div><!--sliderA/-->
     <table class="jia-len">
      <tr>
       <th><strong class="orange">{{$ginfo->g_price}}</strong></th>
       <td>
	   <input type="button" id="jian" value="-" />
        <input type="text" name="buy_num" id="buy_num" value="1" />
		<input type="button" id="jia" value="+" />
       </td>
      </tr>
      <tr>
       <td>
        <strong>{{$ginfo->g_name}}</strong>
        <p class="hui" id="g_num">{{$ginfo->g_num}}</p>
       </td>
       <td align="right">
        <a href="javascript:;" class="shoucang"><span class="glyphicon glyphicon-star-empty"></span></a>
       </td>
      </tr>
     </table>
	 <table class="jrgwc">
      <tr>
       <th>
        <a href="javascript:;"><span class="glyphicon glyphicon-home"></span></a>
       </th>
       <td><a href="javascript:;" id="add_car" >加入购物车</a></td>
      </tr>
     </table>
     <div class="height2"></div>
    
     <div class="height2"></div>
     <div class="zhaieq">
      <a href="javascript:;" class="zhaiCur">商品简介</a>
      <a href="javascript:;">商品参数</a>
      <a href="javascript:;" style="background:none;">订购列表</a>
      <div class="clearfix"></div>
     </div><!--zhaieq/-->
     <div class="proinfoList">
      <img src="{{env('UPLOAD_URL')}}{{$ginfo->g_img}}" width="636" height="822" />
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息....
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息......
     </div><!--proinfoList/-->
     
    </div>
	<script type="text/javascript" src="/jquery.js"></script>
	<script type="text/javascript">
		$(function(){
			$.ajaxSetup({
			 headers: {
			 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			 }
		});
			//+
			$(document).on('click','#jia',function(){
				var _this=$(this);
				var buy_num=parseInt(_this.prev().val());
				var g_num=$("#g_num").text();
				var g_num= parseInt(g_num);
				//console.log(g_num);
				if(buy_num>=g_num){
					_this.prev().val(g_num);
				}else{
					var buy_num1=buy_num+1;
					_this.prev().val(buy_num1);
				}
				
				//console.log(typeof g_num);
				
			});
			//-
			$(document).on('click','#jian',function(){
				var _this=$(this);
				var buy_num=parseInt(_this.next().val());
				;
				if(buy_num<=1){
					_this.next().val(1);
				
				}else{
				var buy_num1=buy_num-1;
				_this.next().val(buy_num1)
				}

			});
			//加入购物车

			$(document).on('click',"#add_car",function(){
				var g_id= {{$ginfo->g_id}};
				//console.log(g_id);
				var buy_num=$("#buy_num").val();
				//console.log(buy_num);
				$.post(
					"{{url('/car_add')}}",
					{g_id:g_id,buy_num:buy_num},
					function(res){
						console.log(res);
						if(res.code==2){

							alert(res.font);
							location.href="/login";
						}else if(res.code==1){
							alert(res.font);
							location.href="/car_list";
						}else{
							alert(res.font);
							location.href="/prolist/.g_id"
						}
					},
					'json'
				);
			});
		})
	</script>
  @include('public.footer');	
 @endsection