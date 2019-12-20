<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Category;
use App\Model\Admin\Goods;

class Index extends Controller
{
    function index(){
		//查询分类
		$cate= Category::where('parent_id','=',0)->get();
		//查询商品
		$res=Goods::where('is_jing','=',1)->get();
		//dd($res);
		$res1=Goods::where('is_new','=',1)->get();
		
		return view('index.index',['cate'=>$cate,'res'=>$res,'res1'=>$res1]);
	}

}
