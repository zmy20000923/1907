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
		品牌名称:<input type="text" name="b_name" value="{{request()->b_name}}"/>&nbsp;
		品牌网址:<input type="text" name="b_url" value="{{request()->b_url}}" />
		<input type="submit" value="筛选" />
	</form>	

	<table class="table table-striped">
	
		<thead>
			<tr>
				<th>品牌id</th>
				<th>品牌名字</th>
				<th>品牌网址</th>
				<th>品牌logo</th>
				<th>品牌介绍</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			@foreach($res as $k=>$v)
			<tr>
				<td>{{$v->b_id}}</td>
				<td>{{$v->b_name}}</td>
				<td>{{$v->b_url}}</td>
				<td><img src="{{env('UPLOAD_URL')}}{{$v->b_logo}}" width="100px" height="100px"/></td>
				<td>{{$v->b_desc}}</td>
				<td>
					<a href="{{url('/brand/destroy/'.$v->b_id)}}" class="btn btn-success">删除</a>
					<a href="{{url('/brand/edit/'.$v->b_id)}}" class="btn btn-success">编辑</a>

				</td>
			</tr>
			@endforeach
		
		</tbody>
</table>
	{{$res->appends($data)->links()}}
 </body>
 <a href="{{url('brand/create')}}" class="btn btn-success" >添加</a>
</html>
