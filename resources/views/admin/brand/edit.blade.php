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
 <body>
	<form class="form-horizontal" role="form" action="{{url('brand/update')}}" method="post" enctype="multipart/form-data">
		@csrf
		<input type="hidden" name="b_id" value="{{$res->b_id}}" />
		<div class="form-group">
			<label for="firstname" class="col-sm-2 control-label">品牌名字</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="firstname" 
					   placeholder="请输入品牌名字" name="b_name" value="{{$res->b_name}}">
					     <b style="color:red">{{$errors->first('b_name')}}</b>
			</div>
		</div>

		<div class="form-group">
			<label for="lastname" class="col-sm-2 control-label">品牌网址</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="lastname" 
					   placeholder="请输入品牌网址" name="b_url" value="{{$res->b_url}}">
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
				<textarea  id="" cols="30" rows="10" name="b_desc">{{$res->b_desc}}</textarea>
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
