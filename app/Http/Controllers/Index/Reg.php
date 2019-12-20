<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;

class Reg extends Controller
{
    function reg(){
		return view('index.reg');
	}
	function regdo(){
	
	}

	public function sendsms(){
		AlibabaCloud::accessKeyClient('<accessKeyId>', '<accessSecret>')
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
				print_r($result->toArray());
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
