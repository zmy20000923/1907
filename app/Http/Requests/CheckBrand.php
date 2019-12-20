<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckBrand extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            
		 'b_name' => 'required|unique:brand|max:255',
		 'b_url' => 'required',
		
        ];
    }


	public function messages(){
		 return [
			'b_name.required'=>"品牌名字不能为空",
			'b_name.unique'=>"品牌名字已存在",
			'b_name.max'=>"品牌名字最大位225位",
			'b_name.min'=>"品牌名字最小位2位",
			'b_url.required'=>"品牌网址不能为空",
		 ];
	}
}
