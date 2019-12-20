<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

/*Route::get('/', function () {
    echo "你好";
});


//Route::get('/aaa',function(){
//	return view('test.index');
//});

Route::get('/aaa',function(){
	return view('test.index');
});

Route::get('/aaa','index\login@login');
*/
//Route::view('/aaa','test.index',['asd'=>'张家口金沙赌场']);
//Route::get('/aaa','index\login@index')->name('qwe');
//Route::post('/logindo','index\login@logindo')->name('asd');
//Route::get('/goods/{id}/{name?}','index\login@goods')->where(['id'=>'\d+']);
//品牌路由

 Route::prefix('/brand')->group(function () {
	Route::get('create','Admin\Brand@create');
	Route::post('store','Admin\Brand@store');
	Route::get('index','Admin\Brand@index');
	Route::get('edit/{b_id}','Admin\Brand@edit');
	Route::post('update','Admin\Brand@update');
	Route::get('destroy/{b_id}','Admin\Brand@destroy');
	Route::post('checkonly','Admin\Brand@checkonly');
 });



//=============================================================//
//分页路由
Route::prefix('/category')->group(function () {
	Route::get('index','Admin\category@index');
	Route::get('create','Admin\category@create');
	Route::post('store','Admin\category@store');
	Route::get('destroy/{c_id}','Admin\category@destroy');
	Route::get('edit/{c_id}','Admin\category@edit');
	Route::post('update/{c_id}','Admin\category@update');
});

//管理员
Route::prefix('/admin')->middleware('CheckLogin')->group(function () {
	Route::get('index','Admin\Admin@index');
	Route::get('create','Admin\Admin@create');
	Route::post('store','Admin\Admin@store');
	Route::get('destroy/{a_id}','Admin\Admin@destroy');
	Route::get('edit/{a_id}','Admin\Admin@edit');
	Route::post('update/{c_id}','Admin\Admin@update');
});
//登录
Route::prefix('/login')->group(function () {
	Route::get('index','Admin\Login@index');
	Route::post('logindo','Admin\Login@logindo');
	
	
});
//商品
Route::prefix('/goods')->group(function () {
	Route::get('index','Admin\goods@index');
	Route::get('create','Admin\goods@create');
	Route::post('store','Admin\goods@store');
	Route::get('destroy/{a_id}','Admin\goods@destroy');
	Route::get('edit/{a_id}','Admin\goods@edit');
	Route::post('update/{c_id}','Admin\goods@update');
	Route::post('checkonly','Admin\goods@checkonly');
});
//文章
Route::prefix('/text')->middleware('CheckText')->group(function () {
	Route::get('index','Admin\text@index');
	Route::get('create','Admin\text@create');
	Route::post('store','Admin\text@store');
	Route::post('destroy','Admin\text@destroy');
	Route::get('edit/{a_id}','Admin\text@edit');
	Route::post('update/{c_id}','Admin\text@update');
	Route::post('onlya','Admin\text@onlya');
});


//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
    return view('layouts.layout');
});
Route::get('/','Index\Index@index');
Route::get('/login','Index\Login@login');
Route::get('/reg','Index\Login@reg');
Route::post('/regdo','Index\Login@regdo');
Route::post('/spendtel','Index\Login@spendtel');
Route::post('/logindo','Index\Login@logindo');
Route::get('/goods/{id}','Index\Goods@goods_list');
Route::get('/prolist/{id}','Index\Goods@prolist');
Route::post('/car_add','Index\Car@car_add');
Route::get('/car_list','Index\Car@car_list');
Route::post('/changebuy_num','Index\Car@changebuy_num');
Route::post('/getprice','Index\Car@getprice');
Route::post('/getcountprice','Index\Car@getcountprice');
Route::post('/del','Index\Car@del');
Route::get('/payadd_show','Index\Pay@payadd_show');
Route::get('/add_address','Index\Address@add_address');
Route::post('/getcity','Index\Address@getcity');
Route::post('/address','Index\Address@address');
Route::get('/submitorder','Index\Order@submitorder');
Route::get('/pay/{order_id}','Index\Order@pay');
Route::get('/success/{id}','Index\Order@success');
