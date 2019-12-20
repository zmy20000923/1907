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
	<meta name="csrf-token" content="{{ csrf_token() }}">
 </head>
 <body>
	<form>
		文章分类: <select name="c_id" id="">
						<option value="">==请选择==</option>
						@foreach($res as $v)
						<option value="{{$v->c_id}}" {{request()->c_id==$v->c_id?'selected':''}}>{{$v->c_name}}</option>
						@endforeach
				  </select>		&nbsp;
		文章名称:<input type="text" name="t_name" value="{{request()->t_name}}" />
		<input type="submit" value="筛选"  />
	</form>	

	<table class="table table-striped">
	
		<thead>
			<tr>
				<th>编号</th>
				<th>文章标题</th>
				<th>文章分类</th>
				<th>文章重要性</th>
				<th>是否显示</th>
				<th>添加日期</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data as $k=>$v)
			<tr t_id="{{$v->t_id}}">
				<td>{{$v->t_id}}</td>
				<td>{{$v->t_name}}</td>
				<td>{{$v->c_name}}</td>
				<td>{{$v->t_z==1?'普通':'置顶'}}</td>
				<td>{{$v->t_show==1?'√':'×'}}</td>
				<td>{{date('Y-m-d h:i:s',$v->t_time)}}</td>
				<td>
					<a href="javascript:;" class="btn btn-success del">删除</a>
					<a href="{{url('/text/edit/'.$v->t_id)}}" class="btn btn-success">编辑</a>

				</td>
			</tr>
			@endforeach
		
		</tbody>
</table>
{{ $data->appends($query)->links()}}
 </body>
 <a href="{{url('/text/create')}}" class="btn btn-success" >添加</a>
</html>
<script type="text/javascript" src="/jquery.js"></script>
<script type="text/javascript">
	$(function(){
		$.ajaxSetup({
			 headers: {
			 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			 }
		})
		$(document).on('click',".del",function(){
			var _this=$(this);
			var t_id= _this.parents('tr').attr('t_id');
			//console.log(t_id);
			//return 1
			$.post(
				"{{url('/text/destroy')}}",
				{t_id:t_id},
				function(res){
					if(res=="ok"){
						_this.parents('tr').remove();
					}else{
						alert('删除失败');
					}
				}
			);
		});
	
	});
</script>
