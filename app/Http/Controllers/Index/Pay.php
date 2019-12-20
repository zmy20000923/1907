<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Index\Cart;
use DB;
use App\Model\Admin\Goods;
use App\Model\Index\Site;
use App\Model\Index\Area;
class Pay extends Controller
{
    function payadd_show(){
		$g_id= request()->g_id;
		
		$u_id= getu_id();
		$where=[
			['u_id','=',$u_id],
			['cart_del','=',1]
		];
		$data= Cart::join('goods as g','cart.g_id','=','g.g_id')->select('g.g_id','g_name','g_img','g_num','buy_num','g_price','cart_time')->where($where)->get();
		//dd($data);
		$counts=0;
		foreach($data as $k=>$v){
			$counts+=$v->g_price*$v->buy_num;
		}
		//查询收货地址
		$arr=[
				['u_id','=',$u_id],
				['is_del','=',1]
			];
		$sinfo= Site::where($arr)->get()->toArray();
		$ainfo= Area::get()->toArray();
		//dd($ainfo);
		foreach($sinfo as $k=>$v){
			$sinfo[$k]['province']=Area::where('id',$v['province'])->value('name');
			$sinfo[$k]['city']=Area::where('id',$v['city'])->value('name');
			$sinfo[$k]['area']=Area::where('id',$v['area'])->value('name');
		}
		

		
		return view('index.payadd_show',['data'=>$data,'counts'=>$counts,'sinfo'=>$sinfo]);
	}
}
