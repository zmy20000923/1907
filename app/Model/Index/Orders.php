<?php

namespace App\Model\Index;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
      //表名
	protected $table="orders";
	//主键id
	protected $primaryKey="order_id";
	//默认时间戳格式
	public $timestamps=false;

	//黑名单
	protected $guarded=[];
	//白名单
	//protected $fillable = ['b_name','b_url'];
}
