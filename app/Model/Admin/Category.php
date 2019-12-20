<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
        //表名
	protected $table="category";
	//主键id
	protected $primaryKey="c_id";
	//默认时间戳格式
	public $timestamps=false;

	//黑名单
	protected $guarded=[];
	//白名单
	//protected $fillable = ['b_name','b_url'];
}
