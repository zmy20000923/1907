<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Index\Area;
use App\Model\Index\Site;

class Address extends Controller
{
    function add_address(){

		//查询省级分类
		$res= $this->getsitle('0');
		
		return view('index.add_address',['res'=>$res]);
	}
	//执行添加
	function address(){
		$u_id= getu_id();
		$data= request()->except('_token');
		//dd($data);
		

		if($data['is_default']==1){
			$where=[
				['u_id','=',$u_id],
				['is_del','=',1]
			];
			
			Site::where($where)->update(['is_default'=>2]);
			
		}
		$data['u_id']=$u_id;
		$res=Site::create($data);
			if($res){
				echo "<script>alert('添加成功');</script>";
			}else{
				echo "<script>alert('添加失败');</script>";
			}


	}
	//获取地址
	function getsitle($pid=0){
		$sitle= Area::where('pid','=',$pid)->get();
		return $sitle;
	}
	//获取市级地址
	function getcity(){
		$id= request()->id;
		$res= $this->getsitle($id);
		echo json_encode($res);
	}

}
