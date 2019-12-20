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
	

	<table class="table table-striped">
	
		<thead>
			<tr>
				<th>分类id</th>
				<th>分类名称</th>
				<th>是否显示</th>
				<th>是否导航栏显示</th>
				<th>parent_id</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			@foreach($res as $k=>$v)
			<tr>
				<td>{{str_repeat('◽',$v['level']*2)}}{{$v['c_id']}}</td>
				<td>{{str_repeat('--',$v['level']*2)}}{{$v['c_name']}}</td>
				<td>{{$v['c_show']==1?'√':'×'}}</td>
				<td>{{$v['c_nav_show']==1?'√':'×'}}</td>
				<td>{{$v['parent_id']}}</td>
				<td>
					<a href="{{url('category/destroy/'.$v['c_id'])}}" class="btn btn-success">删除</a>
					<a href="{{url('category/edit/'.$v['c_id'])}}" class="btn btn-success">编辑</a>

				</td>
			</tr>
			@endforeach
		
		</tbody>
</table>

 </body>
 <a href="{{url('category/create')}}" class="btn btn-success" >添加</a>
</html>
