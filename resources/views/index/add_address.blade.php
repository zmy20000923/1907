@extends('layouts.layout')
@section('title', '商品展示')
@section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>收货地址</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <form action="{{url('/address')}}" method="post" class="reg-login">
		@csrf
      <div class="lrBox">
       <div class="lrList"><input type="text" name="man" placeholder="收货人" /></div>
       
       <div class="lrList">
        <select  class="area" name="province">
         <option value="0" checked="checked">请选择</option>
		 @foreach($res as $v)
			<option value="{{$v->id}}">{{$v->name}}</option>
		 @endforeach
        </select>
    
        <select  class="area" name="city">
         <option>市</option>
        </select>
     
        <select  class="area" name="area">
         <option>区县</option>
        </select>
       </div>
	   <div class="lrList"><input type="text" name="site" placeholder="详细地址" /></div>
       <div class="lrList"><input type="text" name="tel" placeholder="手机" /></div>
       <div class="lrList2">
		
		<select name="is_default" id="">
			<option value="1">默认</option>
			<option value="2">不默认</option>
		</select>
		是否默认
	   </div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" value="保存" />
      </div>
     </form><!--reg-login/-->

	 <script type="text/javascript" src="/jquery.js"></script>
	 <script type="text/javascript">
		$(function(){
			$.ajaxSetup({
				 headers: {
				 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				 }
			});
			$(document).on('change',".area",function(){
				var _this=$(this);
				_this.nextAll('select').html("<option value=''>==请选择==</option>");
				var id = _this.val();
				$.post(
					"{{url('/getcity')}}",
					 {id:id},
					function(res){
						var _option="<option value=''>==请选择==</option>";
						for( var i in res){
							_option+="<option value='"+res[i].id+"'>"+res[i].name+"</option>";
						}
						_this.next('select').html(_option);
					},
					'json'
				)
			});
		})
	 </script>
       @include('public.footer');
   @endsection