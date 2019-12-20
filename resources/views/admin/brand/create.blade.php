<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <link rel="stylesheet" href="/static/css/bootstrap.min.css">  
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Document</title>
 </head>
 <body>		<!-- 验证方法 -->
			<!-- @if ($errors->any())
			 <div class="alert alert-danger">
			 <ul>
			 @foreach ($errors->all() as $error)
			 <li>{{ $error }}</li>
			 @endforeach
			 </ul>
			 </div>
			@endif -->
	<form class="form-horizontal" id="myform" role="form" action="{{url('brand/store')}}" method="post" enctype="multipart/form-data" name="myform">
		@csrf
		<div class="form-group">
			<label for="firstname" class="col-sm-2 control-label">品牌名字</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="firstname" 
					   placeholder="请输入品牌名字" name="b_name">
					   <b style="color:red">{{$errors->first('b_name')}}</b>
			</div>
		</div>

		<div class="form-group">
			<label for="lastname" class="col-sm-2 control-label">品牌网址</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="lastname" 
					   placeholder="请输入品牌网址" name="b_url">
					   <b style="color:red">{{$errors->first('b_url')}}</b>
			</div>
		</div>

		<div class="form-group">
			<label for="lastname" class="col-sm-2 control-label">品牌logo</label>
			<div class="col-sm-10">
				<input type="file" name="b_logo">
			</div>
		</div>
		
		<div class="form-group">
			<label for="lastname" class="col-sm-2 control-label">品牌介绍</label>
			<div class="col-sm-10">
				<textarea  id="" cols="30" rows="10" name="b_desc"></textarea>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-danger">添加</button>
			</div>
		</div>
	</form>

 </body>
</html>
<script type="text/javascript" src="/jquery.js"></script>
<script type="text/javascript">
	$(function(){
		$.ajaxSetup({
		 headers: {
		 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		 }
		});
		$(document).on('blur',"#firstname",function(){
			var _this=$(this);
			checkb_name();

		});
		$(document).on('blur',"#lastname",function(){
			var _this=$(this);
			//alert('111');
			checkb_url();
			

		});
		$(document).on('submit',"#myform",function(){
			var res =checkb_name();
			var	res1= checkb_url();
			return res&&res1
		});

		function checkb_name(_this){
					
			$("#firstname").next().text('');
			var b_name= $("#firstname").val();
			var reg=/^[\u4e00-\u9fa5\w]{2,}$/;
			if(!reg.test(b_name)){
				$("#firstname").next().text('品牌名称由中文数字字母下划线组成最少两位');
				return false;	
			}else{
				$info=false;
				$.ajax({
					method:"post",
					url:"{{url('/brand/checkonly')}}",
					data:{b_name:b_name},
					async:false
				}).done(function(res){
					if(res>0){
						$("#firstname").next().text('品牌名称已存在');
						$info=false;
					}else{
						$("#firstname").next().text('✔');
						$info=true;
					}
				})
				return $info;
			
			}
	
		}
		function checkb_url(){
			$("#lastname").next().text('');
			var b_url=$("#lastname").val();
			var pegs=/^http:\/\/+/;
			if(!pegs.test(b_url)){
				$("#lastname").next().text('品牌网址为http://开头');
				return false;
			}else{
				$("#lastname").next().text('✔');
				return true;
			}
		}
	});
</script>
