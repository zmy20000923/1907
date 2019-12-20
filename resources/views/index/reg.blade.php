	@extends('layouts.layout')
	@section('title', '注册')
	@section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <form action="{{url('/regdo')}}" method="post" class="reg-login">
	 @csrf
      <h3>已经有账号了？点此<a class="orange" href="{{url('/login')}}">登陆</a></h3>
      <div class="lrBox">
       <div class="lrList"><input type="text" name="account" id="tel" placeholder="输入手机号码或者邮箱号" value="{{request()->account}}"/></div>
	   <b style="color:red">{{$errors->first('account')}}</b>
       <div class="lrList2"><input type="text" name="sms"  placeholder="输入短信验证码" value="{{request()->sms}}" /> <button  type="button" id="button">获取验证码</button></div>
	    <b style="color:red">{{$errors->first('sms')}}</b>
		<b style="color:red">{{session('msg')}}</b>
       <div class="lrList"><input type="text" name="pwd" placeholder="设置新密码（6-18位数字或字母）"/></div>
       <div class="lrList"><input type="text" name="pwds" placeholder="再次输入密码" /></div>
	   <b style="color:red">{{session('msgs')}}</b>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" value="立即注册" />
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
			$(document).on('click',"#button",function(){
				var tel= $("#tel").val();
				//console.log(tel);
				$.post(
					"{{url('/spendtel')}}",
					 {tel:tel},
					 function(res){
						if(res.code==1){
							alert(res.font);
						}
					},
					'json'
				);
			});
		})



	 </script>
	 @include('public.footer');
     @endsection
    