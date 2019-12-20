<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Admin;
use Illuminate\Support\Facades\Auth;
class Login extends Controller
{	//登录展示
    function index(){

		return view('admin.login.index');
	}
	//执行登录
	function logindo(){
		$data= request()->except('_token');
			

		if (Auth::attempt($data)) {
			//echo "成功";die;
			 session(['name'=>['name'=>Auth::user(),'id'=>Auth::id()]]);
			request()->session()->save();
			echo "<script>alert('登陆成功');location.href='/admin/index';</script>";
		 // 认证通过...
		 //return redirect()->intended('dashboard');
		}else{
			echo "失败";die;
		}


		/*//dd($data);
		$where=array(
			'account'=>$data['account'],
			'pwd'=>md5($data['pwd'])
		);
		$count= Admin::where($where)->first();
		if($count){
			//session(['name'=>['l_name'=>$count['l_name'],'l_id'=>$count['l_id']]]);
			//session(['name'=>null]);
			//request()->session()->save();
			//$name= session('name');
			//dd($name);
			request()->session()->put('name',['account'=>$count['account'],'a_id'=>$count['a_id']]);
			request()->session()->save();
			
			//request()->session()->pull('name');
			//request()->session()->forget('name');
			$name= request()->session()->get('name');
			//dd($name);
			echo "<script>alert('登陆成功');location.href='/admin/index';</script>";
		}else{
			echo "<script>alert('登陆失败');location.href='index';</script>";	
		}*/
		
	}
}
