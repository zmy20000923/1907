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
	<form class="form-horizontal" role="form" action="{{url('/category/store')}}" method="post" >
		@csrf
		<div class="form-group">
			<label for="firstname" class="col-sm-2 control-label">分类名称</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="firstname" 
					   placeholder="分类名字" name="c_name">
					   <b style="color:red">{{$errors->first('c_name')}}</b>
			</div>
		</div>

		<div class="form-group">
			<label for="lastname" class="col-sm-2 control-label">是否显示</label>
			<div class="col-sm-10">
				<input type="radio" name="c_show" value="1" />是
				<input type="radio" name="c_show" value="2" />否
			</div>
		</div>

		<div class="form-group">
			<label for="lastname" class="col-sm-2 control-label">是否导航栏显示</label>
			<div class="col-sm-10">
				<input type="radio" name="c_nav_show" value="1" />是
				<input type="radio" name="c_nav_show" value="2" />否
			</div>
		</div>
		
		<div class="form-group">
			<label for="lastname" class="col-sm-2 control-label">所属分类</label>
			<div class="col-sm-10">
				<select name="parent_id" id="">
					
					<option value="0">==请选择==</option>
					@foreach($res as $k=>$v)
						<option value="{{$v->c_id}}">{{str_repeat('◽',$v['level']*2)}}{{$v->c_name}}</option>
					@endforeach
				</select>
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
	$(document).on('blur',"#firstname",function(){
		alert('111');
	});
</script>
