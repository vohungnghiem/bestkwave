<?php
Route::get('/', function () {
    return view('welcome');
});

Route::get('admincp/login', ['as' => 'getLogin', 'uses' => 'Admin\AdminLoginController@getLogin']);
Route::post('admincp/login', ['as' => 'postLogin', 'uses' => 'Admin\AdminLoginController@postLogin']);
Route::get('admincp/logout', ['as' => 'getLogout', 'uses' => 'Admin\AdminLoginController@getLogout']);
Route::group(['middleware' => 'AdminMiddleware', 'prefix' => 'admincp', 'namespace' => 'Admin'], function() {
	Route::get('datatables/post','DatatablesController@post');
	Route::get('datatables/banner','DatatablesController@banner');
	Route::get('datatables/subscribe','DatatablesController@subscribe');
	Route::get('/', function() {
		return view('admin.home');
	});
	Route::group(['prefix' => 'account'],function(){
		Route::get('/','AccountController@index');
		Route::get('create','AccountController@create' );
		Route::post('store', 'AccountController@store');
		Route::get('{id}/edit', 'AccountController@edit');
		Route::post('{id}/update', 'AccountController@update');
		Route::get('{id}/destroy', 'AccountController@destroy');
		Route::get('{id}', 'AccountController@show');
		Route::post('status/{id}','AccountController@status');
	});
	Route::group(['prefix' => 'category'],function(){
		Route::get('{root}/list','CategoryController@index');
		Route::get('create','CategoryController@create' );
		Route::post('store', 'CategoryController@store');
		Route::get('{id}/edit', 'CategoryController@edit');
		Route::post('{id}/update', 'CategoryController@update');
		Route::get('{id}/destroy', 'CategoryController@destroy');
		Route::get('{id}', 'CategoryController@show');
		Route::post('status/{id}','CategoryController@status');
		Route::post('sort/{id}', 'CategoryController@sort');
	});
	Route::group(['prefix' => 'typepost'],function(){
		Route::get('/','TypePostController@index');
		Route::get('create','TypePostController@create' );
		Route::post('store', 'TypePostController@store');
		Route::get('{id}/edit', 'TypePostController@edit');
		Route::post('{id}/update', 'TypePostController@update');
		Route::get('{id}/destroy', 'TypePostController@destroy');
		Route::get('{id}', 'TypePostController@show');
		Route::post('status/{id}','TypePostController@status');
		Route::post('sort/{id}', 'TypePostController@sort');
	});
	Route::group(['prefix' => 'post'],function(){
		Route::get('/','PostController@index');
		Route::get('create','PostController@create' );
		Route::post('store', 'PostController@store');
		Route::get('{id}/edit', 'PostController@edit');
		Route::post('{id}/update', 'PostController@update');
		Route::get('{id}/destroy', 'PostController@destroy');
		Route::get('{id}', 'PostController@show');
		Route::post('status/{id}','PostController@status');
		Route::post('sort/{id}', 'PostController@sort');
		
	});
	Route::group(['prefix' => 'banner'],function(){
		Route::get('/','PostController@banner');
		Route::get('create','PostController@createBanner');
		Route::get('{id}/edit', 'PostController@editBanner');
	});
	Route::group(['prefix' => 'social'],function(){
		Route::get('/','SocialController@index');
		Route::get('create','SocialController@create' );
		Route::post('store', 'SocialController@store');
		Route::get('{id}/edit', 'SocialController@edit');
		Route::post('{id}/update', 'SocialController@update');
		Route::get('{id}/destroy', 'SocialController@destroy');
		Route::get('{id}', 'SocialController@show');
		Route::post('status/{id}','SocialController@status');
		Route::post('sort/{id}', 'SocialController@sort');
	});
	Route::group(['prefix' => 'sub'],function(){
		Route::group(['prefix' => 'subsend'],function(){
			Route::get('/','SubSendController@index');
			Route::get('create','SubSendController@create' );
			Route::post('store', 'SubSendController@store');
			Route::get('{id}/edit', 'SubSendController@edit');
			Route::post('{id}/update', 'SubSendController@update');
			Route::get('{id}/destroy', 'SubSendController@destroy');
			Route::get('{id}', 'SubSendController@show');
			Route::post('status/{id}','SubSendController@status');
			Route::post('sort/{id}', 'SubSendController@sort');
		});
		Route::group(['prefix' => 'subreceive'],function(){
			Route::get('/','SubReceiveController@index');
			Route::get('create','SubReceiveController@create' );
			Route::post('store', 'SubReceiveController@store');
			Route::get('{id}/edit', 'SubReceiveController@edit');
			Route::post('{id}/update', 'SubReceiveController@update');
			Route::get('{id}/destroy', 'SubReceiveController@destroy');
			Route::get('{id}', 'SubReceiveController@show');
			Route::post('status/{id}','SubReceiveController@status');
			Route::post('sort/{id}', 'SubReceiveController@sort');
		});
		Route::group(['prefix' => 'subjob'],function(){
			Route::get('/','SubJobController@index');
			Route::get('create','SubJobController@create' );
			Route::post('store', 'SubJobController@store');
			Route::get('{id}/edit', 'SubJobController@edit');
			Route::post('{id}/update', 'SubJobController@update');
			Route::get('{id}/destroy', 'SubJobController@destroy');
			Route::get('{id}', 'SubJobController@show');
			Route::post('status/{id}','SubJobController@status');
			Route::post('sort/{id}', 'SubJobController@sort');
		});
	});
	Route::group(['prefix' => 'subscribe'],function(){
		Route::get('/','SubscribeController@index');
		Route::get('create','SubscribeController@create' );
		Route::post('store', 'SubscribeController@store');
		Route::get('{id}/edit', 'SubscribeController@edit');
		Route::post('{id}/update', 'SubscribeController@update');
		Route::get('{id}/destroy', 'SubscribeController@destroy');
		Route::get('{id}', 'SubscribeController@show');
		Route::post('status/{id}','SubscribeController@status');
		Route::post('sort/{id}', 'SubscribeController@sort');
	});

});


