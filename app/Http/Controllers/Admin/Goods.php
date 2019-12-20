<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Goods as Good;
use App\Model\Admin\Category;
use App\Model\Admin\Brand;
use DB;
use Validator;
use Illuminate\Support\Facades\Cache;

class Goods extends Controller
{
	//展示
    public function index()
    {
		$data= Cache::get('asd');
		if(!$data){
			echo "走Db";
			 $data= Good::join('brand as b','goods.b_id','=','b.b_id')
					->join('category as c','goods.c_id','=','c.c_id')
					->get();
			Cache::put(['asd'=>$data],10);
		}
       
		//dd($data);
		foreach($data as $k=>$v){
			$data[$k]->g_imgs=explode('|',$v->g_imgs);
		}
		return view('admin.goods.index',['data'=>$data]);
    }
	//展示添加
    public function create()
    {
		//分类
		$category= Category::get();
		$cate= get_cate($category);
		$brand= Brand::get();
		//dd($brand);
        return view('admin.goods.create',['cate'=>$cate,'brand'=>$brand]);
    }

	//执行添加
    public function store(Request $request)
    {
		$data= $request->except('_token');
		//dd($data);
		$validator = Validator::make($request->all(), [
			'g_name' => ['required','unique:goods','regex:/^[\x{4e00}-\x{9fa5}]{2,9}$/u'],
			'g_price' => 'required',
		],[
			'g_name.required'=>"商品名称不能为空",
			'g_name.unique'=>"商品名称已存在",
			'g_name.regex'=>"商品名称由中文数字字母下划线组成2-9位",
			'g_price.required'=>"商品价格不能为空",
		]);
		if ($validator->fails()) {
			return redirect('goods/create')
			->withErrors($validator)
			->withInput();
		}
		
		//多文件上传
		if($request->hasFile('g_imgs')){
			$imgs= upload('g_imgs');
			$data['g_imgs']=implode('|',$imgs);
		}

		//文件上传
		if($request->hasFile('g_img')){
			$img= upload('g_img');
			$data['g_img']=$img;
		}
        //if($request->hasFile('photo'))
		$res= Good::create($data);
		if($res){
			echo "<script>alert('成功');location.href='/goods/index';</script>";
		}else{
			echo "<sctipt>alert('失败');location.href='/goods/create';</sctipt>";
		}
    }
	//详情页
    public function show($id)
    {
        //
    }

	//修改
    public function edit($id)
    {




		$category= Category::get();
		$cate= get_cate($category);//分类
        //if($request->hasFile('photo'))
		$brand= Brand::get();//品牌
		$res= Good::where('g_id',$id)->first();
		//dd($res);
		$g_imgs= $res->g_imgs=explode('|',$res->g_imgs);
		//dd($g_imgs);
		return view('admin.goods.edit',['res'=>$res,'cate'=>$cate,'brand'=>$brand,'g_imgs'=>$g_imgs]);
		
    }

	//执行修改
    public function update(Request $request, $id)
    {
		$data= $request->except('_token');


		//多文件上传
		if($request->hasFile('g_imgs')){
			$imgs= upload('g_imgs');
			$data['g_imgs']=implode('|',$imgs);
		}

		//文件上传
		if($request->hasFile('g_img')){
			$img= upload('g_img');
			$data['g_img']=$img;
		}
		$res= Good::where('g_id',$id)->update($data);
		if($res!==false){
			echo "<script>alert('修改成功');location.href='/goods/index';</script>";
		}else{
			echo "<script>alert('修改失败');location.href='/goods/edit/'.$id;</script>";
		}
    }

	//删除
    public function destroy($id)
    {
        $res = Good::destroy($id);
		if($res){
			echo "<script>alert('成功');location.href='/goods/index';</script>";
		}else{
			echo "<sctipt>alert('失败');location.href='/goods/index';</sctipt>";
		}
    }

	//无限极分类
	//无限极分类
	function get_cate($res,$parent_id=0,$level=1){
		static $array=[];
		foreach($res as $k=>$v){
			if($v['parent_id']==$parent_id){
				$v['level']=$level;
				$array[]=$v;
				//print_r($array);
				$this->get_cate($res,$v['c_id'],$v['level']+1);
			}
		}

		return $array;

	}
	//检测唯一性
	function checkonly(){
		$g_name= reuqest()->g_name;
		echo $g_name; 
	}
	
}
