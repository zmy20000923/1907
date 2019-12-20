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
	<form class="form-horizontal" role="form" action="{{url('login/logindo')}}" method="post" >
		@csrf
		<div class="form-group">
			<label for="firstname" class="col-sm-2 control-label">账号</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="firstname" 
					   placeholder="请输入账号" name="name">
					   
			</div>
		</div>

		<div class="form-group">
			<label for="lastname" class="col-sm-2 control-label">密码</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="lastname" 
					   placeholder="请输入密码" name="password">
					  
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-danger">登录</button>
			</div>
		</div>
	</form>

 </body>
</html>
