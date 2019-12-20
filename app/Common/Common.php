<?php

function get_cate($res,$parent_id=0,$level=1){
		static $array=[];
		foreach($res as $k=>$v){
			if($v['parent_id']==$parent_id){
				$v['level']=$level;
				$array[]=$v;
				//print_r($array);
				get_cate($res,$v['c_id'],$v['level']+1);
			}
		}

		return $array;

	}


//多文件上传
	function upload($file){
		$files = request()->file($file);
		if(is_array($files)){
			//多文件上传
			$info=[];
			foreach( $files as $v){
				if ($v->isValid()) {
				$info[]=$store_result =$v->store('uploads');
				}
			}
			return $info;
		}else{
			//文件上传
			if ($files->isValid()) {
				 $store_result =$files->store('uploads');
				 
				 return $store_result;
			}
		}
	}

	//无限极分类
	function getCateId($cateinfo,$parent_id){
	static $cate_id=[];
	$cate_id[$parent_id]=$parent_id;
	
	foreach($cateinfo as $k=>$v){
		if($v['parent_id']==$parent_id){
			$cate_id[$v['c_id']]=$v['c_id'];
			getCateId($cateinfo,$v['c_id']);
			
		}
		
	}
	return $cate_id;				
	}

	//检测是否登录
	function check_login(){
		if(empty(session('user'))){
			echo "<script>alert('请登录');location.href='/login';</script>";die;
		}

	}
	//获取用户id
	function getu_id(){
		$user= session('user');
		return $user['u_id'];
	}


?>