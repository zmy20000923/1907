<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Admin\Goods;
use App\Model\Index\Cart;
use App\Model\Index\Orders;
use App\Model\Index\Site;
use App\Model\Index\Order_address;
use App\Model\Index\Order_detail;

class Order extends Controller
{	//提交订单
    function submitorder(){
		$g_id= request()->g_id;
		$g_id= explode(',',$g_id);
		
		$s_id= request()->s_id;
		$pay_type= request()->pay_type;
		//开启事务
		DB::beginTransaction();
		try{
			$u_id= getu_id();
			if(empty($g_id)){
				throw new \Exception("至少选择一件商品");
			}
			$order=[];
			$order['order_number']=time().rand(10000,99999);
			$order['u_id']=$u_id;
			$where=[
				['u_id','=',$u_id],
				['cart_del','=',1],
				
			];
			$g_price=0;
			$data= Cart::join('goods as g','cart.g_id','=','g.g_id')->select('g.g_id','g_name','g_img','g_num','buy_num','g_price','cart_time')->whereIn('g.g_id',$g_id)->where($where)->get()->toArray();
			foreach($data as $k=>$v){
				$g_price+= $data[$k]['g_price']*$data[$k]['buy_num'];
			}
			$order['order_amount']=$g_price;
			if(empty($pay_type)){
				throw new \Exception("至少选择一种支付方式");
			}
			$order['pay_type']=$pay_type;
			$order['ctime']=time();
			//获取主键id
			$res= Orders::insertGetId($order);
			
			//dd($res);
			//提交事务
			DB::commit();
			if(empty($res)){
				throw new \Exception("订单有误");
				//回滚
				DB::rollBack();
				
			}
			if(empty($s_id)){
				throw new \Exception("至少选择一个收货地址");
			}
			$sinfo= Site::where('s_id',$s_id)->first()->toArray();
			$sinfo['u_id']=$u_id;
			$sinfo['order_id']=$res;
			$sinfo['ctime']=time();
			unset($sinfo['is_del']);
			unset($sinfo['is_default']);
			unset($sinfo['mail']);
			unset($sinfo['s_id']);
			$res2= Order_address::insert($sinfo);
			DB::commit();
			if(empty($res2)){
				throw new \Exception("订单地址有误");
				//回滚
				DB::rollBack();
				
			}
			//订单商品
			foreach($data as $k=>$v){
				$data[$k]['u_id']=$u_id;
				$data[$k]['order_id']=$res;
				unset($data[$k]['cart_time']);
				unset($data[$k]['g_num']);
			}
			//dd($data);
			$res3= Order_detail::insert($data);
			DB::commit();
			if(empty($res3)){
				throw new \Exception("订单商品添加失败");
				//回滚
				DB::rollBack();
				
			}
			//清空购物车
			$where2=[
				['u_id','=',$u_id],
				['cart_del','=',1]
				
			];
			$res4= Cart::whereIn('g_id',$g_id)->where($where)->update(['cart_del'=>2]);
			DB::commit();

			if(empty($res4)){
				throw new \Exception("清除购物车失效");
				//回滚
				DB::rollBack();
			
			}
			//清除库存
			
				foreach($data as $k=>$v){
					$res5= Goods::where('g_id','=',$v['g_id'])->decrement('g_num',$v['buy_num']);
					DB::commit();
						if(empty($res5)){
							throw new \Exception("库存处理错误");
							//回滚
							DB::rollBack();
					
						}
				}
				return	redirect('/success/'.$res);
				//echo "<script>alert('提交成功');location.href='/success/'.$res;</script>";
				
				//echo 1;

		}catch(\Exception $e){
			echo $e->getMessage();
		}
		echo "<script>location.href='/success/'.$res</script>";

	}

	//展示订单
	function success($orders_id){
		$res= Orders::where('order_id','=',$orders_id)->first();
		//dd($res);
		return view('index.success',['res'=>$res]);
	}



	//手机支付
	function pay($order_id){
		
		$order= Orders::select('order_number','order_amount')->where('order_id',$order_id)->first();
		//dd($order);
			
			require_once app_path('lib/alipay/wappay/service/AlipayTradeService.php');
			require_once app_path('lib/alipay/wappay/buildermodel/AlipayTradeWapPayContentBuilder.php');
			$config= config('alipay');
			if (!empty($order->order_number)&& trim($order->order_number)!=""){
			//商户订单号，商户网站订单系统中唯一订单号，必填
			$out_trade_no = $order->order_number;

			//订单名称，必填
			$subject = "孟洋商贸";

			//付款金额，必填
			$total_amount = $order->order_number;

			//商品描述，可空
			$body = '';

			//超时时间
			$timeout_express="1m";

			$payRequestBuilder = new \AlipayTradeWapPayContentBuilder();
			$payRequestBuilder->setBody($body);
			$payRequestBuilder->setSubject($subject);
			$payRequestBuilder->setOutTradeNo($out_trade_no);
			$payRequestBuilder->setTotalAmount($total_amount);
			$payRequestBuilder->setTimeExpress($timeout_express);

			$payResponse = new \AlipayTradeService($config);
			$result=$payResponse->wapPay($payRequestBuilder,$config['return_url'],$config['notify_url']);

			return ;
		}
	}


}
