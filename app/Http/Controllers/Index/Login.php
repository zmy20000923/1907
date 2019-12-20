<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use App\Model\Index\User;
use Validator;
use Illuminate\Support\Facades\Hash;

class Login extends Controller
{
	//登录
    function login(){
		//dd($name);
		return view('index.login');
	}
	//执行登录
	function logindo(){
		$tel= request()->account;
		$pwd= request()->pwd;

		$data= User::where('account','=',$tel)->first();
		//dd($data);
		 $validator = Validator::make(request()->all(),[
		 'account' => 'required',
		 'pwd'=>'required',
		 ],[
			'account.required'=>"账号不能为空",
			 'pwd.required'=>"密码不能为空",
		 ]);
		 if ($validator->fails()) {
		 return redirect('/login')
		 ->withErrors($validator)
		 ->withInput();
		 }

		 if (Hash::check($pwd,$data['pwd'])){
			 session(['user'=>$data]);
			 request()->session()->save();
			echo "<script>alert('登陆成功');location.href='/';</script>";
		}else{
			echo "<script>alert('登陆失败');location.href='/login';</script>";
		}
		//dd($pwd);
		
	}
	//注册
	function reg(){
		return view('index.reg');
	}
	//执行注册
	function regdo(){
		//echo 1;die;
		$data= request()->except('_token');
		$code= session('code_'.$data['account']);
		//dd($data);
		 $validator = Validator::make(request()->all(),[
		 'account' => ['required','unique:user','regex:/^\d{11}$/'],
		 'sms'=>'required',
		 ],[
			'account.required'=>"手机号不能为空",
			'account.unqiue'=>"手机号已存在",
			 'account.regex'=>'手机号必须是数字11位',
			 'sms.required'=>"验证码不能为空",
		 ]);
		 if ($validator->fails()) {
		 return redirect('/reg')
		 ->withErrors($validator)
		 ->withInput();
		 }
		
		if($data['sms']!=$code){
			return redirect('/reg')->with('msg','验证码错误');
		}
		if($data['pwd']!=$data['pwds']){
			return redirect('/reg')->with('msgs','密码不一致');
		}
		$data['reg_time']=time();
		//dd($data);
		$user=new User;
		$user->account=$data['account'];
		$user->pwd=Bcrypt($data['pwd']);
		$user->reg_time=$data['reg_time'];
		$user->save($data);
		$res=$user;
		if($res){
			echo "<script>alert('注册成功');location.href='/login';</script>";
		}else{
			echo "<script>alert('注册失败');location.href='/login';</script>";
		}

	}

	function spendtel(){
		$tel= request()->tel;
		//echo $tel;die;

		$code= rand(100000,999999);
		$res= $this->sendsms($tel,$code);

		if($res){
			session(["code_".$tel=>$code]);
			request()->session()->save();//存储到服务端
			//session($tel)
			$arr= ['font'=>'发送成功','code'=>1];
			echo json_encode($arr);exit;
		}else{
			$arr= ['font'=>'发送失败','code'=>2];
			echo json_encode($arr);exit;
		}
	}

	//发送短信
	public function sendsms($tel,$code){
		AlibabaCloud::accessKeyClient('LTAI4FeSFV7uTLB9rymtfPFa', 'yUw5Z5cE7p3DLI5HlRnymwQyMuOvUA')
                        ->regionId('cn-hangzhou')
                        ->asDefaultClient();

			try {
				$result = AlibabaCloud::rpc()
									  ->product('Dysmsapi')
									  // ->scheme('https') // https | http
									  ->version('2017-05-25')
									  ->action('SendSms')
									  ->method('POST')
									  ->host('dysmsapi.aliyuncs.com')
									  ->options([
													'query' => [
													  'RegionId' => "cn-hangzhou",
													  'PhoneNumbers' => $tel,
													  'SignName' => "人挺好",
													  'TemplateCode' => "SMS_176530851",
													  'TemplateParam' => "{code:$code}",
													],
												])
									  ->request();
				//print_r($result->toArray());
			} catch (ClientException $e) {
				echo $e->getErrorMessage() . PHP_EOL;
				return false;
			} catch (ServerException $e) {
				echo $e->getErrorMessage() . PHP_EOL;
				return false;
			}
			return true;
	}
}
