<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Category as Cate;

class Category extends Controller
{
  
	 //展示
    public function index()
    {	
		$res= Cate::all()->toArray();
		//dd($res);
	
		$info= get_cate($res);
		//dd($info);

		return view('admin.category.index',['res'=>$info]);

    }

  
	 //展示添加
    public function create()
    {
		$res= Cate::all();
		//dd($res);
	
		$info= get_cate($res);
		//dd($info);
        return view('admin.category.create',['res'=>$info]);
    }

    
	 //执行添加
    public function store(Request $request)
    {
        $data=$request->except('_token');

		$validator = Validator::make($request->all(), [
		 'c_name' => 'required|unique:category|max:255',
		 ],[
			'c_name.required'=>'分类名字不能为空',	
		]);
		 if ($validator->fails()) {
		 return redirect('category/create')
		 ->withErrors($validator)
		 ->withInput();
		 }
		$res= Cate::create($data);
		if($res){
			echo "<script>alert('添加成功');location.href='/category/index'</script>";
		}else{
			echo "<script>alert('添加失败');location.href='/category/create'</script>";
		}
	
    }

    
	 //详情
    public function show($id)
    {
        
    }

   
	 //修改
    public function edit($c_id)
    {
        //dd($c_id);
		$res= Cate::all();
		$info= $this->get_cate($res);

		$data= Cate::find($c_id);
		return view('admin.category.edit',['res'=>$info,'data'=>$data]);
    }

   
	 //执行修改
    public function update(Request $request, $c_id)
    {
		$data=$request->except('_token');
		$res= Cate::where('c_id','=',$c_id)->update($data);
		if($res!==false){
			echo "<script>alert('修改成功');location.href='/category/index';</script>";
		}else{
			echo "<script>alert('修改失败');location.href='/category/edit';</script>";
		}
    }

  
	 //删除
    public function destroy($c_id)
    {
        $res= Cate::destroy($c_id);
		if($res){
			echo "<script>alert('成功');location.href='/category/index'</script>";
		}else{
			echo "<script>alert('失败');location.href='/category/index'</script>";
		}
    }

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
	
}
