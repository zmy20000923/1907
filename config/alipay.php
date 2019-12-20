<?php
return array (	
		//应用ID,您的APPID。
		'app_id' => "2016101500691434",

		//商户私钥，您的原始格式RSA私钥
		'merchant_private_key' => "MIIEpAIBAAKCAQEAytEa9InTg1nI1Stxbh8te8n8Scxkac4SobUmf2NFtTrl2rPgSXRFlcCj5S/P6v0RWxe/c8JuJZOZzbB2PGIYGAX/HZez5dCOPvRWbyDmbsx91KKtYmQlbBlAM1LZ/ZOF33DA/77lu+DpzNy3sDo5tmJaZ89oVOvNj4N9WG0rULCBFVN/avVDbiU7KgjXP+YA5ZJpd2dWqFDyPZANvMIVJENP5ckieKxUWE1dEs/KkxQzbVMwy56rs28mY7cQmtpyEbo2tdMqMHaXHhCyUbR0mJqMHybB+i9scEZb2uQo6cGKcC/n2ETIVAlu2lNlDUFm6b+lt5jjUrpStLhnis9wJwIDAQABAoIBAGBEPnohzV6ESFo+Q5nUfJ9MMU7KEENUR+2vcTV35kduTFmxlVzoLns1M9X+Cr9sHUfSjtIgUG3PkGpcPtLMcMk+V2gxcHc9tbbV/QzEXfvrXjKGgKu6AzU7CwkRY10EH7/94e3CK4Mw72iIvzuLd4dFScoKXWgpgKmE7QMC1lN2iqYdRgufqyQFzC26VkYNDrSaujnC7mWjAZwFSp2ZvLM7AZtEqeErvfvnwn/1MCcG45HNHtgsKJERVa9umozcYznIT7k8oKG45jMZv2dA1Enfj8xVpemOZ0vFkkDyoIW4P/MchmScLqFg4YfGXwJiH34YYh67II5UPA0EIYS4o2ECgYEA+bqlYQ/OY9W7vkGMjSvwBUi+FPvgEMJBLBtxHoEolWXTGPDNMf4bIy/ihh8fZd18Th4nfbmtS0EuIWR7Y413gKPl3Lh1ytmP4EM5LrVXX69B9r9zFBF8SHoAwVcHMQocZwBkCaRMus/cIpPjHx62dWSee9y93fPZVzqmC9WhJVcCgYEAz+jjqNAMXAFynOrNUY43zCWPx0Hvm3uCR4cqWAOC9rZNNxxvVZ1KjB+KJnHLb2XdM3XtPUKWn0k/FFB3N7wT9ltwpSFVbHRkVzWyncwtDqJ9afaWyHCRn06C6hEibDakhh+xdHFKqP6hS7XLfhOZjVaur+pEhdkqQY79cTil+bECgYBHLx3fCfth19XZSKQAxap4RyDvqFBZVpXvNa9L67MeytSegl1rR6yCni6q3oo7piO9vLizDM9J6T12BUdqvDN5Nr7Z6Lai6NsrKN5O4yARxUo/RJlP+h/8JNK8Scth/ijUb3cUjIHWqlNsg8003LNTySen1OdGMjEcvToBm5aApwKBgQDMEJTrS5Dl+VHKbLgrlUB08mUluTT50gc0N5m7G28+wf4V2qX4TVMvJ4HMbCK16zBq4xOA7kuyeg0c3kG1hbe+NU/h9E7JDZCy/HSdZxrOY3RfPfYPNFXqHABox3qW5icjshXV6aDTMGGWUxAxZgFv9aWt6m1pRpawFC30JBrccQKBgQDDj9mHMhE1tAr2u/jxV9KKVYCvRnC6MFQAnNdxN/x1RePwBHIJQm7sl8qKg7+Ykex6aw32CmxeAE4rmP5VG4DtPE4jtuPHhDcxNB3P8ISZjxg9D85ZNH0brqP0Vmr7z3DyJ+EVpQ/k1sn1Q/8jNG3XmH2uRMCMXntrRLdsAzIumw==",
		
		//异步通知地址
		'notify_url' => "http://www.1907laravel.com/alipay/notify_url.php",
		
		//同步跳转
		'return_url' => "http://www.1907laravel.com/alipay/return_url.php",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAhZfdIQtZUrv0M6OEMMk1zIZ5acZpQuCL+774DREoabmYDRxS5h9EFqAx9K8ccWUSVZtOlWSy12vTwNClA3zSN1NnTAixs98w+Pm+xP3rS8FP7y37+N7/r6G/izv8V5N1WOCoksnZtvpi/wXfNOZsbpk8nZrpUXQeFfD1y6mWWveCOVvR+/fR0DoxVC21DAH9pZK+PerU2fi4Sn5cHaIwBtVnnrlMCyWd90/ghrsPgGL9h/rX8mlyro2Bk1oAww7Sg/bXpjZ2+T6DqXO9MOhOS8xehgDcImqxktnVkFzKYIwsvTTMcNPQMQdfggrJLhF7Gr720EYaVQJqgFBbQDMrUQIDAQAB",
		
	
);