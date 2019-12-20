<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Index\Cart;
use DB;
use App\Model\Admin\Goods;
class Car extends Controller
{
	//购物车展示
	function car_list(){
		$u_id= getu_id();
		$where=[
			['u_id','=',$u_id],
			['cart_del','=',1]
		];
		$data= Cart::join('goods as g','cart.g_id','=','g.g_id')->select('g.g_id','g_name','g_img','g_num','buy_num','g_price','cart_time')->where($where)->orderBy('cart_time','desc')->get();
		//dd($data);

		//dd($user);
		return view('index.car_list',['data'=>$data]);
	}
	//加入购物车
    function car_add(){
		if(empty(session('user'))){
			$arr=['font'=>"请登录",'code'=>2];
			echo json_encode($arr);die;
		}else{
			$u_id= getu_id();
			$g_id= request()->g_id;
			$buy_num= request()->buy_num;
			$where=[
				['g_id','=',$g_id],
				['u_id','=',$u_id],
				['cart_del','=',1]
			];
			$carinfo= Cart::where($where)->first();
			if($carinfo){
				$res= Cart::where($where)->update(['buy_num'=>$carinfo['buy_num']+$buy_num]);
					if($res){
					
					$arr=['font'=>"加入成功",'code'=>1];
					echo json_encode($arr);die;
				}else{
					
					$arr=['font'=>"加入失败",'code'=>3];
					echo json_encode($arr);die;
				}
			}

			$data=array(
				'g_id'=>$g_id,
				'u_id'=>$u_id,
				'buy_num'=>$buy_num,
				'cart_time'=>time()
			);
			$data=request()->except('_token');
			$data['u_id']=$u_id;
			$data['cart_time']=time();
			$res= Cart::create($data);
			if($res){
				
				$arr=['font'=>"加入成功",'code'=>1];
				echo json_encode($arr);die;
			}else{
				
				$arr=['font'=>"加入失败",'code'=>3];
				echo json_encode($arr);die;
			}
		}
	}
	//改变购买数量
	function changebuy_num(){
		$u_id=getu_id();
		$g_id= request()->g_id;
		$buy_num= request()->buy_num;
		//echo $g_id;
		//echo $buy_num;
		$where=[
			['g_id','=',$g_id],
			['cart_del','=',1],
			['u_id','=',$u_id]
		];
		$res= Cart::where($where)->update(['buy_num'=>$buy_num]);
		
		if($res!==false){
			echo "ok";
		}else{
			echo "no";
		}
	
	}
	//获取小计
	function getprice(){
		$u_id=getu_id();
		$g_id= request()->g_id;
		$where=[
			['g_id','=',$g_id],
			['cart_del','=',1],
			['u_id','=',$u_id]
		];
		$g_price= Goods::select('g_price')->where('g_id',$g_id)->first();
		//print_r($g_price);die;
		$buy_num = Cart::select('buy_num')->where($where)->first();
		$price= $g_price->g_price*$buy_num->buy_num;
		echo $price;
		
	}
	//获取总价
	function getcountprice(){
		$g_id= request()->g_id;
		$g_id= explode(',',$g_id);
		$u_id=getu_id();
		$where=[
			['cart_del','=',1],
			['u_id','=',$u_id]
		];
		$g_price= Goods::join('cart as c','goods.g_id','=','c.g_id')
									->select('buy_num','g_price')
									->whereIn('c.g_id',$g_id)
									->where($where)->get();
		$countprice=0;
		 foreach($g_price as $v){
			$countprice+=$v->buy_num*$v->g_price;
		 }
		 echo $countprice;
	}
	//删除
	function del(){
		$g_id= request()->g_id;
		$g_id= explode(',',$g_id);
		$u_id=getu_id();
		$where=[
		
			['cart_del','=',1],
			['u_id','=',$u_id]
		];
		$res= Cart::whereIn('g_id',$g_id)->where($where)->update(['cart_del'=>2]);
		if($res){
			echo "ok";
		}else{
			echo "no";
		}

	}


}
