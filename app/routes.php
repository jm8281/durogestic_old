<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
/**
 * 后台路径导航
 */
Route::get('/adm/login', array('uses' => 'AdmUserController@Login')); //后台用户登录
Route::post('/adm/login', array('uses' => 'AdmUserController@LoginDo')); //处理登录
Route::get('/adm/logout', array('uses' => 'AdmUserController@LogOut')); //用户注销

Route::group(array('before' => 'auth'), function() 		//所有后台模块都要受用户访问限制。
	{
		Route::controller('/adm/user','AdmUserController');//用户管理模块
		Route::controller('/adm/expert','AdmExpertController');//专家后台管理模块
		Route::controller('/adm/video','AdmVideoController');   //直播/录播后台管理模块
		Route::get('/adm/{other?}',function(){return View::make('adm.index');});//后台首页
	});

/**
 * 前台路径导航
 */ 
Route::controller('/test','testController'); //代码测试页，用完即删
Route::controller('/review', 'ReviewController'); //往期视频前台模块
Route::controller('/conf', 'ConfController'); // 会议预告前台模块
Route::controller('/expert', 'ExpertController');  //专家前台模块
Route::get('/{other?}', array('uses'=>'HomeController@Index')); //首页调用模块


/**
Route::get('/', function()
{
	return View::make('hello');
});
**/
