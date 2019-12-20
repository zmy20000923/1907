<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Model\Admin\Brand as Brands;
use App\Http\Requests\CheckBrand;
use Validator;
//use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Illuminate\Validation\Rule;
class Brand extends Controller
{
   
	 //展示
    public function index()
    {
		$b_name=request()->b_name;
		$b_url=request()->b_url;
		$where=[];
		if(!empty($b_name)){
			$where[]=['b_name','like',"%$b_name%"];
		}
		if(!empty($b_url)){
			$where[]=['b_url','like',"%$b_url%"];
		}
		$page= request()->page;
		//Cache::flush();
			

		//$res= Cache::get('data_'.$page.'_'.$b_name.'_'.$b_url);
		
		$res=Redis::get('data_'.$page.'_'.$b_name.'_'.$b_url);
		$res= unserialize($res);
		echo 'data_'.$page.'_'.$b_name.'_'.$b_url;
		if(!$res){

			echo "走Db";
			
			//dd($data);
			//DB::connection()->enableQueryLog();
        $res= Brands::where($where)->paginate(2);
		 
		Redis::setex('data_'.$page.'_'.$b_name.'_'.$b_url,15,serialize($res));
		//Cache::put(['data_'.$page.'_'.$b_name.'_'.$b_url=>$res],10);
		//
		//dd($data);
			//$logs = DB::getQueryLog();
			//dd($logs);

		\Cookie::queue('name','11aaa',5);
		}
			//$value= \Cookie::get('name');
			$value= request()->cookie('name');
			//dd($value);
			$data= request()->input();
		return view('admin.brand.index',['res'=>$res,'data'=>$data]);
    }


     
	 //展示添加
    public function create()
    {
	
       return view('admin/brand/create');
    }
	
	 //执行添加
	 //第二种验证
    //public function store(CheckBrand $request)
    public function store(Request $request)
    {	//第一种验证方法
		/*
		$validatedData = $request->validate([
			'b_name' => 'required|unique:brand|max:255|min:2',
			'b_url' => 'required',
		],[
			'b_name.required'=>"品牌名字不能为空",
			'b_name.unique'=>"品牌名字已存在",
			'b_name.max'=>"品牌名字最大位225位",
			'b_name.min'=>"品牌名字最小位2位",
			'b_url.required'=>"品牌网址不能为空",
			
		]);
		*/
		

		$post=$request->except('_token');

		$validator = Validator::make($post, [
			 'b_name' => 'required|unique:brand|max:255',
			 'b_url' => 'required',
		 ],[
			'b_name.required'=>"品牌名字不能为空",
			'b_name.unique'=>"品牌名字已存在",
			'b_name.max'=>"品牌名字最大位225位",
			'b_name.min'=>"品牌名字最小位2位",
			'b_url.required'=>"品牌网址不能为空",	
		]);
		 if ($validator->fails()) {
			 return redirect('brand/create')
			 ->withErrors($validator)
			 ->withInput();
		 }
		
		if($request->hasFile('b_logo')){
			$post['b_logo']=$this->upload('b_logo');
		}else{
			echo "没有文件上传";die;
		}
		$res= Brands::create($post);
		//dd($res);
		if($res){
			return	redirect('/brand/index');
		}
		
    }

   //展示详情
    public function show($id)
    {
        //
    }

   
	 //修改
    public function edit()
    {
        $post=request()->b_id;
		//dd($post);
		$res= DB::table('brand')->where('b_id','=',$post)->first();
		//dd($res);
		return view('admin.brand.edit',['res'=>$res]);

    }

    
	//执行修改
    public function update(Request $request)
    {
		$post=$request->except('_token');

		$validator = Validator::make($post, [
			 'b_name' => [
				'required',
				Rule::unique('brand')->ignore($post['b_id'],'b_id'),
				'max:255',
				'min:2'	
			],
			 'b_url' => 'required',
		 ],[
			'b_name.required'=>"品牌名字不能为空",
			'b_name.unique'=>"品牌名字已存在",
			'b_name.max'=>"品牌名字最大位225位",
			'b_name.min'=>"品牌名字最小位2位",
			'b_url.required'=>"品牌网址不能为空",	
		]);
		 if ($validator->fails()) {
			 return redirect('brand/edit/'.$post['b_id'])
			 ->withErrors($validator)
			 ->withInput();
		 }

		if($request->hasFile('b_logo')){
			$post['b_logo']=$this->upload('b_logo');
		}
		$b_id=$request->b_id;
		//dd($b_id);
		$res= Brands::where('b_id','=',$b_id)->update($post);
		if($res!==false){
			echo "<script>alert('修改成功');location.href='/brand/index';</script>";
			//return	redirect('/brand/index');
		}
    }

   
	 //删除
    public function destroy($b_id)
    {
		$data= Brands::destroy($b_id);
		if($data){
			echo "<script>alert('删除成功');location.href='/brand/index';</script>";
			//return	redirect('/brand/index');
		}
    }

	//上传文件
	function upload($file){
		if (request()->file($file)->isValid()) {
			 $photo = request()->file($file);
		
			 $store_result = $photo->store('uploads');
			 //$store_result = $photo->storeAs('photo', 'test.jpg');
			return $store_result;
		
		 }
	}

	//验证唯一性
	function checkonly(){
		$b_name= request()->b_name;
		$count= Brands::where('b_name','=',$b_name)->count();
		echo $count;
	}
}
