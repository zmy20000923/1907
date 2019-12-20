<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <title>Document</title>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 条纹表格</title>
	 <link rel="stylesheet" href="/static/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>
	<form>
		管理员账号<input type="text" name="account" />&nbsp;
		<input type="submit" value="筛选" />
	</form>	

	<table class="table table-striped">
	
		<thead>
			<tr>
				<th>管理员id</th>
				<th>管理员账号</th>
				<th>管理员头像</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			@foreach($res as $k=>$v)
			<tr>
				<td>{{$v->a_id}}</td>
				<td>{{$v->account}}</td>
				<td><img src="{{env('UPLOAD_URL')}}{{$v->img}}" width="100px" height="100px"/></td>
				<td>
					<a href="{{url('/admin/destroy/'.$v->a_id)}}" class="btn btn-success">删除</a>
					<a href="{{url('/admin/edit/'.$v->a_id)}}" class="btn btn-success">编辑</a>

				</td>
			</tr>
			@endforeach
		
		</tbody>
</table>

 </body>
 <a href="{{url('admin/create')}}" class="btn btn-success" >添加</a>
</html>
