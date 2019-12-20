<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Text as Te;
use App\Model\Admin\Cate;
use Validator;
use Illuminate\Validation\Rule;
class Text extends Controller
{
    //显示
    public function index()
    {
		$c_id= request()->c_id;
		$t_name= request()->t_name;
		$where=[];
		if(!empty($c_id)){
			$where[]=['text.c_id','=',$c_id];	
		}
		if(!empty($t_name)){
			$where[]=['t_name','like',"%$t_name%"];
		}
		//dd($info);

		$res= Cate::get();

		$data=Te::join('cate as c','text.c_id','=','c.c_id')->where($where)->paginate(2);
		$query=request()->all();
		return view('admin.text.index',['res'=>$res,'data'=>$data,'query'=>$query]);
    }

    //展示添加
    public function create()
    {
		$res= Cate::get();
		
        return view('admin.text.create',['res'=>$res]);
    }

    //执行添加
    public function store(Request $request)
    {
        $data= $request->except('_token');
		//文件上传
		if($request->hasFile('t_img')){
			$data['t_img']=upload('t_img');
		}
		$data['t_time']=time();
		$validator = Validator::make($request->all(), [
		  't_name' => 'required|unique:text|regex:/^[\x{4e00}-\x{9fa5}\w]{4,}$/u',
		 'c_id' => 'required',
		 't_z' => 'required',
		 't_show'=>'required',
		],[
			't_name.required'=>"文章标题不能为空",
			't_name.unique'=>"文章标题已存在",
			't_name.regex'=>"标题由中文字母数字下划线组成 最少四位",
			'c_id.required'=>"文章分类不能为空",
			't_z.required'=>"文章重要性不能为空",
			't_show.required'=>"文章是否显示不能为空",
		]);
		if ($validator->fails()) {
		 return redirect('text/create')
		 ->withErrors($validator)
		 ->withInput();
		 }
		 $res= Te::create($data);
		 if($res){
			echo "<script>alert('添加成功');location.href='/text/index';</script>";
		 }else{
			echo "<script>alert('添加失败');location.href='/text/create';</script>";
		 }

    }

    //详情
    public function show($id)
    {
        //
    }

   //展示修改
    public function edit($id)
    {	
		$res= Cate::get();
		$data= Te::where('t_id',$id)->join('cate as c','text.c_id','=','c.c_id')->first();
		return view('admin.text.edit',['data'=>$data,'res'=>$res]);
    }

    //执行修改
    public function update(Request $request, $id)
    {
         $data= $request->except('_token');
		//文件上传
		if($request->hasFile('t_img')){
			$data['t_img']=upload('t_img');
		}
		$data['t_time']=time();
		$validator = Validator::make($request->all(), [
		  't_name' => ['required','unique:text','regex:/^[\x{4e00}-\x{9fa5}\w]{4,}$/u',Rule::unique('text')->ignore($id,'t_id')],
		 'c_id' => 'required',
		 't_z' => 'required',
		 't_show'=>'required',
		],[
			't_name.required'=>"文章标题不能为空",
			't_name.unique'=>"文章标题已存在",
			't_name.regex'=>"标题由中文字母数字下划线组成 最少四位",
			'c_id.required'=>"文章分类不能为空",
			't_z.required'=>"文章重要性不能为空",
			't_show.required'=>"文章是否显示不能为空",
		]);
		if ($validator->fails()) {
		 return redirect('text/edit/'.$id)
		 ->withErrors($validator)
		 ->withInput();
		 }
		
		 $res= Te::where('t_id',$id)->update($data);
		 if($res!==false){
			echo "<script>alert('修改成功');location.href='/text/index';</script>";
		 }else{
			echo "<script>alert('修改失败');location.href='/text/edit/'.$id;</script>";
		 }
    }

	//删除
    public function destroy()
    {


		$t_id= request()->t_id;
		
		$res= Te::destroy($t_id);
		if($res){
			echo "ok";
		}else{
			echo "no";
		}
        /*$res= Te::where('t_id',$id)->destroy();
		if($res){
			echo "<script>alert('删除成功');location.href='/text/index';</script>";
		 }else{
			echo "<script>alert('删除失败');location.href='/text/index';</script>";
		}*/
    }

	function onlya(){
		$t_name= request()->t_name;
		$count= Te::where('t_name','=',$t_name)->count();
		if($count>0){
			echo "no";
		}else{
			echo "ok";
		}
	}
}
