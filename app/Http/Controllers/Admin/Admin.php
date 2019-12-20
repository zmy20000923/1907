<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Admin as Ad;
class Admin extends Controller
{
   //展示
    public function index()
    {	
		$account= request()->account;
		//dd($account)
		$where=[];
		if(!empty($account)){
			$where[]=['account','like',"%$account%"];
		}

		$res= Ad::where($where)->get();
		return view('admin.admin.index',['res'=>$res]);
    }

   //添加展示
    public function create()
    {
        return view('admin.admin.create');
    }

    //执行添加
    public function store(Request $request)
    {
        $data= $request->except('_token');
		//dd($data);

		if($request->hasFile('img')){
			$data['img']=$this->upload('img');
		}
		$data['pwd']=md5($data['pwd']);
		$res= Ad::create($data);
		if($res){
			echo "<script>alert('添加成功');location.href='/admin/index';</script>";
		}else{
			echo "<script>alert('添加失败');location.href='/admin/create';</script>";
		}
    }

    //详情
    public function show($id)
    {
        //
    }

   //修改
    public function edit($id)
    {
		$res= Ad::find($id);
        return view('admin.admin.edit',['res'=>$res]);
    }

    //执行修改
    public function update(Request $request, $id)
    {
         $data= $request->except('_token');
		//dd($data);

		if($request->hasFile('img')){
			$data['img']=$this->upload('img');
		}else{
			echo "<script>alert('文件有误');location.href='/admin/edit/'.$id;</script>";;
		}
		$res= Ad::where('a_id',$id)->update($data);
		if($res){
			echo "<script>alert('修改成功');location.href='/admin/index';</script>";
		}else{
			echo "<script>alert('修改失败');location.href='/admin/edit/'.$id;</script>";
		}
    }

    //删除
    public function destroy($a_id)
    {
        $res= Ad::destroy($a_id);
		if($res){
			echo "<script>alert('成功');location.href='/admin/index';</script>";
		}else{
			echo "<script>alert('失败');location.href='/admin/index';</script>";
		}
    }

	//文件上传
	public function upload($files){
		if (request()->file($files)->isValid()) {
			 $photo = request()->file($files);
			 $store_result = $photo->store('uploads');
			 //$store_result = $photo->storeAs('photo', 'test.jpg');
			return $store_result;
		}
		 
	}
}
