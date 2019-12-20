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
	<div class="page-content">
							<div class="row">
								

									<div class="col-xs-12">
									
									<form class="form-horizontal" role="form" action="{{url('/goods/update/'.$res->g_id)}}" method="post" enctype="multipart/form-data" >
									@csrf
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 商品名称</label>

										<div class="col-sm-9">
											<input type="text" id="form-field-1" placeholder="商品名称" class="col-xs-10 col-sm-5" name="g_name" value="{{$res->g_name}}"/>
										</div>
									</div>

									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 商品价格 </label>

										<div class="col-sm-9">
											<input type="text" id="form-field-2" placeholder="商品价格" class="col-xs-10 col-sm-5" name="g_price" value="{{$res->g_price}}"/>
										</div>
									</div>

									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 商品库存</label>

										<div class="col-sm-9">
											<input type="text" id="form-field-2" placeholder="商品库存" class="col-xs-10 col-sm-5" name="g_num" value="{{$res->g_num}}"/>
										</div>
									</div>

									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 商品积分 </label>

										<div class="col-sm-9">
											<input type="text" id="form-field-2" placeholder="商品积分" class="col-xs-10 col-sm-5"  name="g_jifen" value="{{$res->g_jifen}}"/>
										</div>
									</div>

									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 商品货号 </label>

										<div class="col-sm-9">
											<input type="text" id="form-field-2" placeholder="商品货号" class="col-xs-10 col-sm-5" name="g_hh" value="{{$res->g_hh}}"/>
										</div>
									</div>

									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 商品图片 </label>

										<div class="col-sm-9">
											<input type="file" id="form-field-2" class="col-xs-10 col-sm-5" name="g_img"/>
											<img src="{{env('UPLOAD_URL')}}{{$res->g_img}}" alt="" width="80px" height="80px"/>
										</div>
									</div>

									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 商品相册 </label>

										<div class="col-sm-9">
											<input type="file" id="form-field-2"  class="col-xs-10 col-sm-5" name="g_imgs[]" multiple/>
											@foreach($g_imgs as $v6)
												<img src="{{env('UPLOAD_URL')}}{{$v6}}" alt=""  width="80px" height="80px"/>
											@endforeach
										</div>
									</div>

									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 商品详情 </label>

										<div class="col-sm-9">
											<textarea id="" cols="30" rows="10" name="g_desc">{{$res->g_desc}}</textarea>
										</div>
									</div>

									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 是否新品</label>

										<div class="col-sm-9">
											<input type="radio" name="is_new" value="1" {{$res->is_new==1?'checked':''}}/>
											<input type="radio" name="is_new" value="2" {{$res->is_new==2?'checked':''}} />
										</div>
									</div>

									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 是否精品 </label>

										<div class="col-sm-9">
											<input type="radio" name="is_jing" value="1" {{$res->is_jing==1?'checked':''}}/>
											<input type="radio" name="is_jing" value="2" {{$res->is_jing==2?'checked':''}} />
										</div>
									</div>

									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 是否热卖 </label>

										<div class="col-sm-9">
											<input type="radio" name="is_host" value="1" {{$res->is_host==1?'checked':''}}/>
											<input type="radio" name="is_host" value="2" {{$res->is_host==2?'checked':''}}/>
										</div>
									</div>

									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 是否上架 </label>

										<div class="col-sm-9">
											<input type="radio" name="is_up" value="1" {{$res->is_up==1?'checked':''}}/>
											<input type="radio" name="is_up" value="2" {{$res->is_new==1?'checked':''}}/>
										</div>
									</div>

									<div class="space-4"></div>

									<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 品牌 </label>

														<div class="col-sm-9">
															<select	 name="b_id" >
																<option value="0">==请选择==</option>
																@foreach($brand as $k=>$v)
																	<option value="{{$v->b_id}}" {{$res->b_id==$v->b_id?'selected':''}}  >{{$v->b_name}}</option>
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
																	<option value="{{$v->c_id}}" {{$res->c_id==$v->c_id?'selected':''}}>{{str_repeat('◽',$v['level']*2)}}{{$v->c_name}}</option>
																@endforeach
																
																
															</select>
															</div>
									</div>



									

								
									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<button class="btn btn-info" type="submit">
												<i class="icon-ok bigger-110"></i>
												编辑
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
