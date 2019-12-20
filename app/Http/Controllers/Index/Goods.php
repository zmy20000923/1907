<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Category;
use App\Model\Admin\Goods as Good;
class Goods extends Controller
{
	function goods_list($c_id=''){
			$cateinfo= Category::get();
			
			 $cate_id= getCateId($cateinfo,$c_id);
			 //dd($cate_id);
			
			 $ginfo= Good::whereIn('c_id',$cate_id)->get();
			 //dd($ginfo);
		
		return view('index.goods_list',['ginfo'=>$ginfo]);
	}
	//商品详情
	function prolist($g_id=''){
		$ginfo= Good::where('g_id','=',$g_id)->first();
		$ginfo->g_imgs=explode('|',$ginfo->g_imgs);
		//dd($ginfo);
		return view('index.prolist',['ginfo'=>$ginfo]);
	}
    
}
