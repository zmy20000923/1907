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
	<form class="form-horizontal" role="form" action="{{url('/text/update/'.$data->t_id)}}" method="post" enctype="multipart/form-data">
		@csrf
		<div class="form-group">
			<label for="firstname" class="col-sm-2 control-label">文章标题</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="firstname" 
					    name="t_name" value="{{$data->t_name}}">
						<b style="color:red">{{$errors->first('t_name')}}</b>
			</div>
		</div>

		<div class="form-group">
			<label for="lastname" class="col-sm-2 control-label">文章分类</label>
			<div class="col-sm-10">
				<select name="c_id" id="">
					<option value="">请选择</option>
					@foreach($res as $v)
						<option value="{{$v->c_id}}"{{$data->c_id==$v->c_id?'selected':''}}>{{$v->c_name}}</option>
					@endforeach
				</select>
				<b style="color:red">{{$errors->first('c_id')}}</b>
					   
			</div>
		</div>

		<div class="form-group">
			<label for="lastname" class="col-sm-2 control-label">文章重要性</label>
			<div class="col-sm-10">
				<input type="radio" name="t_z" value="1" {{$data->t_z==1?"checked":""}}>普通
				<input type="radio" name="t_z" value="2" {{$data->t_z==2?"checked":""}}>置顶
				<b style="color:red">{{$errors->first('t_z')}}</b>
			</div>
		</div>

		<div class="form-group">
			<label for="lastname" class="col-sm-2 control-label">是否显示</label>
			<div class="col-sm-10">
				<input type="radio" name="t_show" value="1"  {{$data->t_show==1?"checked":""}}>显示
				<input type="radio" name="t_show" value="2"	 {{$data->t_show==2?"checked":""}}>不显示
				<b style="color:red">{{$errors->first('t_show')}}</b>
			</div>
		</div>

		<div class="form-group">
			<label for="firstname" class="col-sm-2 control-label">文章作者</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="firstname" 
					    name="t_people" value="{{$data->t_prople}}">
					  
			</div>
		</div>

		<div class="form-group">
			<label for="firstname" class="col-sm-2 control-label">作者email</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="firstname" 
					    name="t_email" value="{{$data->t_email}}">
					  
			</div>
		</div>

		<div class="form-group">
			<label for="firstname" class="col-sm-2 control-label">关键字</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="firstname" 
					  name="t_key" value="{{$data->t_key}}">
					  
			</div>
		</div>
		
		<div class="form-group">
			<label for="lastname" class="col-sm-2 control-label">网页描述</label>
			<div class="col-sm-10">
				<textarea  id="" cols="30" rows="10" name="t_desc">{{$data->t_desc}}</textarea>
			</div>
		</div>
		<div class="form-group">
			<label for="lastname" class="col-sm-2 control-label">上传文件</label>
			<div class="col-sm-10">
				<input type="file" name="t_img" />
				<img src="{{env('UPLOAD_URL')}}{{$data->t_img}}" alt="" width="100px" height="100px" />
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
