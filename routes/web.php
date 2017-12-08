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
//前台首页
Route::get('/','Home\IndexController@index');
//关于我们
Route::get('/about','Home\AboutController@index');
//新闻
Route::get('/news','Home\NewsController@index');
//作者
Route::get('/authors','Home\AuthorsController@index');



//后台首页
Route::get('/admin/index','Admin\IndexController@index');
//后台welcome
Route::get('/admin/welcome','Admin\IndexController@welcome');
//后台article
Route::group(['prefix' => 'article'], function () {
	//文章列表
    Route::get('/show','Admin\ArticleController@show');
    //添加文章
    Route::get('/add','Admin\ArticleController@add');
    
});
//后台category
Route::group(['prefix' => 'category'], function () {
	//栏目列表
    Route::get('/show','Admin\CategoryController@show');
    //添加栏目
    Route::get('/add','Admin\CategoryController@add');
});
//后台system
Route::group(['prefix' => 'system'], function () {
	//柱状图
    Route::get('/bar','Admin\SystemController@bar');
    //系统设置
    Route::get('/setting','Admin\SystemController@setting');
    //屏蔽词
    Route::get('/shielding','Admin\SystemController@shielding');

});

//后台Navigate
Route::group(['prefix' => 'navigate'],function(){
    //导航列表
    Route::get('/show','Admin\NavigateController@show');
    //添加导航
    Route::match(['get', 'post'],'/create','Admin\NavigateController@create');
});
