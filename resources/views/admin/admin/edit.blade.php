<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <link rel="stylesheet" href="/static/css/bootstrap.min.css">  

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
	<form class="form-horizontal" role="form" action="{{url('/admin/update/'.$res->a_id)}}" method="post" enctype="multipart/form-data">
		@csrf
		<div class="form-group">
			<label for="firstname" class="col-sm-2 control-label">管理员账号</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="firstname" 
					   placeholder="请输入管理员账号" name="account" value="{{$res->account}}">
					   
			</div>
		</div>

		<div class="form-group">
			<label for="lastname" class="col-sm-2 control-label">管理员密码</label>
			<div class="col-sm-10">
				<input type="pwd" class="form-control" id="lastname" 
					   placeholder="请输入管理员密码" name="pwd" value="{{$res->pwd}}">
					 
			</div>
		</div>

		<div class="form-group">
			<label for="lastname" class="col-sm-2 control-label">管理员头像</label>
			<div class="col-sm-10">
				<img src="{{env('UPLOAD_URL')}}{{$res->img}}" width="100px" height="100px"/>
				<input type="file" name="img">
			</div>
		</div>
	

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-danger">修改</button>
			</div>
		</div>
	</form>

 </body>
</html>
