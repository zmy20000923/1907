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
				<th>商品id</th>
				<th>商品名称</th>
				<th>商品价格</th>
				<th>商品库存</th>
				<th>商品图片</th>
				<th>商品相册</th>
				<th>商品介绍</th>
				<th>商品积分</th>
				<th>是否新品</th>
				<th>是否精品</th>
				<th>是否热卖</th>
				<th>是否新品</th>
				<th>是否上架</th>
				<th>品牌</th>
				<th>分类</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data as $k=>$v)
			<tr>
				<td>{{$v->g_id}}</td>
				<td>{{$v->g_name}}</td>
				<td>{{$v->g_price}}</td>
				<td>{{$v->g_num}}</td>
				<td><img src="{{env('UPLOAD_URL')}}{{$v->g_img}}" alt="" width="80px" height="80px"/></td>
				<td>
					@foreach($v->g_imgs as $v8)
						<img src="{{env('UPLOAD_URL')}}{{$v8}}" alt="" width="80px" height="80px"/>
					@endforeach
				</td>
				<td>{{$v->g_desc}}</td>
				<td>{{$v->g_jifen}}</td>
				<td>{{$v->is_new}}</td>
				<td>{{$v->is_jing}}</td>
				<td>{{$v->is_host}}</td>
				<td>{{$v->is_up}}</td>
				<td>{{$v->is_new}}</td>
				<td>{{$v->b_name}}</td>
				<td>{{$v->c_name}}</td>
				<td>
					<a href="{{url('/goods/destroy/'.$v->g_id)}}"class="btn btn-success">删除</a>
					<a href="{{url('/goods/edit/'.$v->g_id)}}" class="btn btn-success">编辑</a>

				</td>
			</tr>
			@endforeach
		
		</tbody>
</table>
	
 </body>
 <a href="{{url('goods/create')}}" class="btn btn-success" >添加</a>
</html>
