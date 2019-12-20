@extends('layouts.layout')
@section('title', '购物车列表')
@section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>购物车</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <table class="shoucangtab">
      <tr>
       <td width="75%"><span class="hui">购物车共有：<strong class="orange">2</strong>件商品</span></td>
       <td width="25%" align="center" style="background:#fff url(/static/index/images/xian.jpg) left center no-repeat;">
        <span class="glyphicon glyphicon-shopping-cart" style="font-size:2rem;color:#666;"></span>
       </td>
      </tr>
     </table>
    
     <div class="dingdanlist">
      <table>
       <tr>
        <td width="100%" colspan="4"><a href="javascript:;"><input type="checkbox" id="allbox" name="1" /> 全选</a></td>
       </tr>
	    @foreach($data as $k=>$v)
       <tr g_id="{{$v->g_id}}">
        <td width="4%"><input type="checkbox" name="1" class="xuan" /></td>
        <td class="dingimg" width="15%"><img src="{{env('UPLOAD_URL')}}{{$v->g_img}}" /></td>
        <td width="50%">
         <h3>{{$v->g_name}}</h3>
         <time>{{date('Y-m-d h:i:s',$v->cart_time)}}</time>
        </td>
		<td width="50%">
         <h3>小计</h3>
         <strong class="orange">{{$v->g_price*$v->buy_num}}</strong>
        </td>
        <td align="right">
			<input type="button" id="less" g_id="{{$v->g_id}}"  class="less" value="-" style="width:30px">
			<input value="{{$v->buy_num}}" id="buy_number" type="text" size="15" g_num="{{$v->g_num}}" style="text-align:center;vertical-align:middel;width:30px;height:27px;"/>
			<input type="button" id="add" class="add" g_id="{{$v->g_id}}" value="+"style="width:30px">
		</td>
       </tr>
       
	   @endforeach
	   <tr>
        <td width="100%" colspan="4"><a href="javascript:;"><input type="button" name="1" id="del" value="删除" /></a></td>
       </tr>
      </table>
     </div><!--dingdanlist/-->
 
     <!--dingdanlist/-->
     <div class="height1"></div>
     <div class="gwcpiao">
     <table>
      <tr>
       <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
       <td width="50%">总计：<strong class="orange" id="countprice">¥</strong></td>
       <td width="40%"><a href="javascript:;" class="jiesuan" id="accounts">去结算</a></td>
      </tr>
     </table>
    </div><!--gwcpiao/-->
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{asset('/static/index/js/jquery.min.js')}}"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{asset('/static/index/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('/static/index/js/style.js')}}"></script>
    <!--jq加减-->
    <script src="{{asset('/static/index/js/jquery.spinner.js')}}"></script>
   <script>
	$('.spinnerExample').spinner({});
	</script>
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
		//加号
		$(document).on('click',".add",function(){
			var _this=$(this);
			var buy_num=parseInt(_this.prev().val());
			//console.log(buy_num);
			var g_num= parseInt(_this.prev().attr('g_num'));
			if(buy_num>=g_num){
				_this.prev().val(g_num);
			}else{
				
				var buy_num1=buy_num+1;
				_this.prev().val(buy_num1);
			}
			var g_id= _this.attr('g_id');
			//console.log(g_id);
			//改变购买数量
			var buy_num=parseInt(_this.prev().val());
			changebuy_num(_this,g_id,buy_num)
			//获取小计
			getprice(g_id,_this)
			//改变选中
			changecheck(_this)
			//获取总价
			getcountprice();
			//var box= $(".xuan:checked");
			//console.log(box);
			/*var g_id="";
			box.each(function(index){
				g_id+=$(this).parents('tr').attr('g_id')+',';
			});
			g_id=g_id.substr(0,g_id.length-1);
			$.post(
				"{{url('del')}}",
				 {g_id:g_id},
				 function(res){
					console.log(res)
				}
			)*/

		});
		//减号
		$(document).on('click',".less",function(){
			var _this=$(this);
			var buy_num=parseInt(_this.next().val());
			//console.log(buy_num);
			var g_num= parseInt(_this.next().attr('g_num'));
			if(buy_num<=1){
				_this.next().val(1);
			}else{
			
				var buy_num1=buy_num-1;
				 _this.next().val(buy_num1);
			}
			var g_id= _this.attr('g_id');

			var buy_num=parseInt(_this.next().val());

		
			changebuy_num(_this,g_id,buy_num);
			getprice(g_id,_this)

			changecheck(_this)
			//获取总价
			getcountprice();
		});

		//复选框
		$(document).on('click',".xuan",function(){
			getcountprice();
		})
		//全选
		$(document).on('click',"#allbox",function(){
			var _this=$(this);
			var status= _this.prop('checked');
			if(status==true){
				$(".xuan").prop('checked',status);
				getcountprice();
			}else{
				$(".xuan").prop('checked',status);
				getcountprice();
			}
		})
		//删除
		$(document).on('click',"#del",function(){
			var box= $(".xuan:checked");
			//console.log(box);
			var g_id="";
			box.each(function(index){
				g_id+=$(this).parents('tr').attr('g_id')+',';
			});
			g_id=g_id.substr(0,g_id.length-1);
			$.post(
				"{{url('/del')}}",
				 {g_id:g_id},
				 function(res){
					if(res=="ok"){
						box.each(function(index){
							$(this).parents('tr').remove();						});
					}
				}
			)
		});

		
		//结算
		$(document).on('click',"#accounts",function(){
				accounts();
			
		});
		//改变购买数量 数据库加1
		function changebuy_num(_this,g_id,buy_num){
			$.ajax({
				method:'post',
				url:"{{url('/changebuy_num')}}",
				 data:{g_id:g_id,buy_num:buy_num},
                async:false
			}).done(function(res){
				console.log(res)
			});
		}
		//改变小计
		function getprice(g_id,_this){
			$.post(
				"{{url('/getprice')}}",
				{g_id:g_id},
				function(res){
					_this.parent().prev().find(".orange").text('￥'+res);
					//console.log(res);
				}
			)
		}
		//改变选中
		function changecheck(_this){
			_this.parents('tr').find(".xuan").prop('checked',true);
		}
		//获取总价钱
		function getcountprice(){
			var box= $(".xuan:checked");
			//console.log(box);
			var g_id="";
			box.each(function(index){
				g_id+=$(this).parents('tr').attr('g_id')+',';
			});
			g_id=g_id.substr(0,g_id.length-1);
			$.post(
				"{{url('getcountprice')}}",
				 {g_id:g_id},
				 function(res){
					$("#countprice").text('￥'+res);
				}
			)
		}

		//确认结算
		function accounts(){
			var box= $(".xuan:checked");

				if(box.length>0){
					//console.log(box);
				var g_id="";
				box.each(function(index){
					g_id+=$(this).parents('tr').attr('g_id')+',';
				});
				g_id=g_id.substr(0,g_id.length-1);
				location.href="{{url('/payadd_show')}}?g_id="+g_id;
			}else{
				alert('至少选择一件商品');

			}
			
		}

	})
</script>
 @endsection