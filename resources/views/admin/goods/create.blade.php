<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <link rel="stylesheet" href="/static/css/bootstrap.min.css">  
  <meta name="csrf-token" content="{{ csrf_token() }}">
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
	<div class="page-content">
							<div class="row">
								

									<div class="col-xs-12">
									
									<form class="form-horizontal" role="form" action="{{url('/goods/store')}}" method="post" enctype="multipart/form-data" >
									@csrf
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 商品名称</label>

										<div class="col-sm-9">
											<input type="text" id="form-field-1" placeholder="商品名称" class="col-xs-10 col-sm-5" name="g_name" />
											<b style="color:red">{{$errors->first('g_name')}}</b>
										</div>
									</div>

									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 商品价格 </label>

										<div class="col-sm-9">
											<input type="text" id="form-field-2" placeholder="商品价格" class="col-xs-10 col-sm-5" name="g_price"/>
											<b style="color:red">{{$errors->first('g_price')}}</b>
										</div>
									</div>

									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 商品库存</label>

										<div class="col-sm-9">
											<input type="text" id="form-field-2" placeholder="商品库存" class="col-xs-10 col-sm-5" name="g_num"/>
										</div>
									</div>

									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 商品积分 </label>

										<div class="col-sm-9">
											<input type="text" id="form-field-2" placeholder="商品积分" class="col-xs-10 col-sm-5"  name="g_jifen"/>
										</div>
									</div>

									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 商品货号 </label>

										<div class="col-sm-9">
											<input type="text" id="form-field-2" placeholder="商品货号" class="col-xs-10 col-sm-5" name="g_hh"/>
										</div>
									</div>

									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 商品图片 </label>

										<div class="col-sm-9">
											<input type="file" id="form-field-2" class="col-xs-10 col-sm-5" name="g_img"/>
										</div>
									</div>

									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 商品相册 </label>

										<div class="col-sm-9">
											<input type="file" id="form-field-2"  class="col-xs-10 col-sm-5" name="g_imgs[]" multiple/>
										</div>
									</div>

									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 商品详情 </label>

										<div class="col-sm-9">
											<textarea id="" cols="30" rows="10" name="g_desc"></textarea>
										</div>
									</div>

									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 是否新品</label>

										<div class="col-sm-9">
											<input type="radio" name="is_new" value="1" checked/>
											<input type="radio" name="is_new" value="2" />
										</div>
									</div>

									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 是否精品 </label>

										<div class="col-sm-9">
											<input type="radio" name="is_jing" value="1" checked/>
											<input type="radio" name="is_jing" value="2" />
										</div>
									</div>

									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 是否热卖 </label>

										<div class="col-sm-9">
											<input type="radio" name="is_host" value="1" checked/>
											<input type="radio" name="is_host" value="2" />
										</div>
									</div>

									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 是否上架 </label>

										<div class="col-sm-9">
											<input type="radio" name="is_up" value="1" checked/>
											<input type="radio" name="is_up" value="2" />
										</div>
									</div>

									<div class="space-4"></div>

									<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 品牌 </label>

														<div class="col-sm-9">
															<select	 name="b_id" >
																<option value="0">==请选择==</option>
																@foreach($brand as $k=>$v)
																	<option value="{{$v->b_id}}">{{$v->b_name}}</option>
																@endforeach
																
															</select>
															</div>
									</div>

									<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 分类 </label>

														<div class="col-sm-9">
															<select name="c_id" >
																<option value="0">==请选择==</option>
																@foreach($cate as $k=>$v)
																	<option value="{{$v->c_id}}">{{str_repeat('◽',$v['level']*2)}}{{$v->c_name}}</option>
																@endforeach
																
																
															</select>
															</div>
									</div>



									

								
									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<button class="btn btn-info" type="submit">
												<i class="icon-ok bigger-110"></i>
												增加
											</button>

											&nbsp; &nbsp; &nbsp;
											<button class="btn" type="reset">
												<i class="icon-undo bigger-110"></i>
												重置
											</button>
										</div>
									</div>

									<div class="hr hr-24"></div>



								</form>
									</div><!-- /span -->
								</div><!-- /row -->

					</div><!-- /.page-content -->

 </body>
</html>
<script type="text/javascript" src="/jquery.js"></script>
<script type="text/javascript">
	$(function(){
		$.ajaxSetup({
		 headers: {
		 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		 }
		});
		$(document).on('blur',"#form-field-1",function(){
			var g_name= $("#form-field-1").val();
			//console.log(g_name);
				$("#form-field-1").next().text('');
			var reg=/^[\u4e00-\u9fa5]{2,9}$/;
			if(!reg.test(g_name)){
				$("#form-field-1").next().text('商品名称由中文组成2-9位');
				return false;
			}else{
				$.ajax({
					method:"post",
					url:"{{url('/goods/checkonly')}}",
					data:{g_name:g_name},
					async:false					
				}).done(function(res){
					console.log(res);
				})
			}
		});

	});
		
</script>

