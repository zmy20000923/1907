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
	<form class="form-horizontal" role="form" id="myform"  action="{{url('text/store')}}" method="post" enctype="multipart/form-data">
		@csrf
		<div class="form-group">
			<label for="firstname" class="col-sm-2 control-label">文章标题</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="firstname" 
					    name="t_name" >
						<b style="color:red">{{$errors->first('t_name')}}</b>
					  
			</div>
		</div>

		<div class="form-group">
			<label for="lastname" class="col-sm-2 control-label">文章分类</label>
			<div class="col-sm-10">
				<select name="c_id" id="c_id">
					<option value="">请选择</option>
					@foreach($res as $v)
						<option value="{{$v->c_id}}">{{$v->c_name}}</option>
					@endforeach
				</select>
				<b style="color:red">{{$errors->first('c_id')}}</b>
					   
			</div>
		</div>

		<div class="form-group">
			<label for="lastname" class="col-sm-2 control-label">文章重要性</label>
			<div class="col-sm-10">
				<input type="radio" name="t_z" value="1" class="t_z">普通
				<input type="radio" name="t_z" value="2" class="t_z">置顶
				<b style="color:red">{{$errors->first('t_z')}}</b>
			</div>
		</div>

		<div class="form-group">
			<label for="lastname" class="col-sm-2 control-label">是否显示</label>
			<div class="col-sm-10">
				<input type="radio" name="t_show" value="1" class="t_show">显示
				<input type="radio" name="t_show" value="2" class="t_show">不显示
				<b style="color:red">{{$errors->first('t_show')}}</b>
			</div>
		</div>

		<div class="form-group">
			<label for="firstname" class="col-sm-2 control-label">文章作者</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="firstname" 
					    name="t_people">
					  
			</div>
		</div>

		<div class="form-group">
			<label for="firstname" class="col-sm-2 control-label">作者email</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="firstname" 
					    name="t_email">
					  
			</div>
		</div>

		<div class="form-group">
			<label for="firstname" class="col-sm-2 control-label">关键字</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="firstname" 
					  name="t_key">
					  
			</div>
		</div>
		
		<div class="form-group">
			<label for="lastname" class="col-sm-2 control-label">网页描述</label>
			<div class="col-sm-10">
				<textarea  id="" cols="30" rows="10" name="t_desc"></textarea>
			</div>
		</div>
		<div class="form-group">
			<label for="lastname" class="col-sm-2 control-label">上传文件</label>
			<div class="col-sm-10">
				<input type="file" name="t_img" />
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
		/*$(document).on('submit',"#myform",function(){
				var res=t_name();
				var res1=c_id();
				var res2=t_z();
				var res3=t_show();
			
			return res&&res1&&res2&&res3;
		});*/



		//检测文章标题
		function t_name(){
			var t_name= $("#firstname").val();
			//console.log(t_name);
				var pag=/^[\u4e00-\u9fa5\w]{4,}$/;
			if(t_name==""){
				alert('文章标题不能为空');
				return false;
			}else if(!pag.test(t_name)){
				alert('文章标题由中文数字字母下划线组成 最少四位');
				return false;
			}else{
				$info=false
				$.ajax({
					method:"post",
					url:"{{url('/text/onlya')}}",
					data:{t_name:t_name},
					async:false
				}).done(function(res){
					if(res=='ok'){
						$info=true;
					}else{
						alert('文章标题已存在');
						$info=false;
					}
					
				})
				return $info;
			}
		}
		//检测文章分类
		function c_id(){
			var c_id= $("#c_id").val();
			if(c_id==""){
				alert('文章分类不能为空');
				return false;
			}else{
				return true;
			}
		}
		//检测文章重要性
		function t_z(){
			var t_z= $(".t_z").val();
			if(t_z==""){
				alert('文章重要性不能为空');
				return false;
			}else{
				return true;
			}
		}
		//检测是否显示为空
		function  t_show(){
			var t_show= $(".t_show").val();
			if(t_show==""){
				alert('文章是否显示不能为空');
				return false;
			}else{
				return true;
			}
		}
	});
</script>
