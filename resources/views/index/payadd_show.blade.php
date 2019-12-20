@extends('layouts.layout')
@section('title', '购物车订单列表展示')
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
     <div class="dingdanlist" >
      
	  <div class="dingdanlist" id="div" style="height: 200px;border: 2px solid red; overflow: auto" >
       @if(empty($sinfo))
		<a href="">添加地址</a>
	   @else
			@foreach($sinfo as $k=>$v)
				<br>
					<table border="0" class="peo_tab" style="width:550px;" cellspacing="0" cellpadding="0">

					  <tr >
						<td rowspan="2"  class="getsid"><input type="radio" name="a" {{$v['is_default']==1?'checked':''}}  s_id="{{$v['s_id']}}"/></td>
						<td class="p_td" width="160">收货人姓名</td>
						<td width="395">{{$v['man']}}</td>
						<td class="p_td" width="160">电话</td>
						<td width="395">{{$v['tel']}}</td>
					  </tr>
					  <tr>
						<td class="p_td">详细信息</td>
						<td>{{$v['province']}}{{$v['city']}}{{$v['area']}}{{$v['site']}}</td>
						<td class="p_td">邮政编码</td>
						<td>{{$v['mail']}}</td>
					  </tr>
					</table>
				<br>
			@endforeach
	   @endif
	   </div>
	   <table>
       <tr><td colspan="3" style="height:10px; background:#efefef;padding:0;"></td></tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">选择收货时间</td>
        <td align="right"><img src="/static/index/images/jian-new.png" /></td>
       </tr>
       <tr><td colspan="3" style="height:10px; background:#efefef;padding:0;"></td></tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">支付方式</td>
        <td align="right">
			<select name="" id="pay_type">
				<option value="1">微信支付</option>
				<option value="2">支付宝支付</option>
				
			</select>
		</td>
       </tr>
       <tr><td colspan="3" style="height:10px; background:#efefef;padding:0;"></td></tr>
      
       <tr><td colspan="3" style="height:10px; background:#fff;padding:0;"></td></tr>
       <tr>
        <td class="dingimg" width="75%" colspan="3">商品清单</td>
       </tr>
       
		@foreach($data as $k=>$v)
       <tr>
        <td class="dingimg" width="15%"><img src="{{env('UPLOAD_URL')}}{{$v->g_img}}" width="100px" height="100px" /></td>
        <td width="50%">
         <h3>{{$v->g_name}}</h3>
         <time>下单时间：2015-08-11  13:51</time>
        </td>
        <td align="right"><span class="qingdan">X{{$v->buy_num}}</span></td>
       </tr>
       <tr>
        <th colspan="3"><strong class="orange">¥{{$v->g_price*$v->buy_num}}</strong></th>
       </tr>
       @endforeach
       <tr>
        <td class="dingimg" width="75%" colspan="2">商品金额</td>
        <td align="right"><strong class="orange">{{$counts}}</strong></td>
       </tr>
		
      </table>
     </div><!--dingdanlist/-->
     
     
    </div><!--content/-->
    
    <div class="height1"></div>
    <div class="gwcpiao">
     <table>
      <tr>
       <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
       <td width="50%">总计：<strong class="orange">{{$counts}}</strong></td>
       <td width="40%"><a href="javascript:;" class="jiesuan" id="submitorder">提交订单</a></td>
      </tr>
     </table>
    </div><!--gwcpiao/-->
	<script type="text/javascript" src="/jquery.js"></script>
	<script type="text/javascript">
		$(function(){
			$(document).on('click',"#submitorder",function(){
				var g_id="{{request()->g_id}}";//商品id
				var s_id=$("#div").find(':radio:checked').attr('s_id');//收货地址id
				var pay_type=$("#pay_type").val();
				//console.log(pay_type);
				location.href="{{url('/submitorder/')}}?g_id="+g_id+"&s_id="+s_id+"&pay_type="+pay_type;
				
			});
		});
	</script>
	@endsection
   