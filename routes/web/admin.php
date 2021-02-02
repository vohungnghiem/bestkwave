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

	Route::group(['prefix' => 'standad'],function(){
		Route::get('/','StandadController@index');
		Route::get('create','StandadController@create' );
		Route::post('store', 'StandadController@store');
		Route::get('{id}/edit', 'StandadController@edit');
		Route::post('{id}/update', 'StandadController@update');
		Route::get('{id}/destroy', 'StandadController@destroy');
		Route::get('{id}', 'StandadController@show');
		Route::post('status/{id}','StandadController@status');
		Route::post('sort/{id}', 'StandadController@sort');
	});

	Route::group(['prefix' => 'advertisement'],function(){
		Route::get('/','AdvertisementController@index');
		Route::get('create','AdvertisementController@create' );
		Route::post('store', 'AdvertisementController@store');
		Route::get('{id}/edit', 'AdvertisementController@edit');
		Route::post('{id}/update', 'AdvertisementController@update');
		Route::get('{id}/destroy', 'AdvertisementController@destroy');
		Route::get('{id}', 'AdvertisementController@show');
		Route::post('status/{id}','AdvertisementController@status');
		Route::post('sort/{id}', 'AdvertisementController@sort');
	});

	Route::group(['prefix' => 'information'],function(){
		Route::get('/','InformationController@index');
		Route::get('create','InformationController@create' );
		Route::post('store', 'InformationController@store');
		Route::get('{id}/edit', 'InformationController@edit');
		Route::post('{id}/update', 'InformationController@update');
		Route::get('{id}/destroy', 'InformationController@destroy');
		Route::get('{id}', 'InformationController@show');
		Route::post('status/{id}','InformationController@status');
		Route::post('sort/{id}', 'InformationController@sort');
	});

	Route::group(['prefix' => 'idolplus'],function(){
		Route::group(['prefix' => 'agency'],function(){
			Route::get('/','AgencyController@index');
			Route::get('create','AgencyController@create' );
			Route::post('store', 'AgencyController@store');
			Route::get('{id}/edit', 'AgencyController@edit');
			Route::post('{id}/update', 'AgencyController@update');
			Route::get('{id}/destroy', 'AgencyController@destroy');
			Route::get('{id}', 'AgencyController@show');
			Route::post('status/{id}','AgencyController@status');
			Route::post('sort/{id}', 'AgencyController@sort');
		});
		Route::group(['prefix' => 'group'],function(){
			Route::get('/','GroupController@index');
			Route::get('create','GroupController@create' );
			Route::post('store', 'GroupController@store');
			Route::get('{id}/edit', 'GroupController@edit');
			Route::post('{id}/update', 'GroupController@update');
			Route::get('{id}/destroy', 'GroupController@destroy');
			Route::get('{id}', 'GroupController@show');
			Route::post('status/{id}','GroupController@status');
			Route::post('sort/{id}', 'GroupController@sort');
		});
		Route::group(['prefix' => 'agency'],function(){
			Route::get('/','AgencyController@index');
			Route::get('create','AgencyController@create' );
			Route::post('store', 'AgencyController@store');
			Route::get('{id}/edit', 'AgencyController@edit');
			Route::post('{id}/update', 'AgencyController@update');
			Route::get('{id}/destroy', 'AgencyController@destroy');
			Route::get('{id}', 'AgencyController@show');
			Route::post('status/{id}','AgencyController@status');
			Route::post('sort/{id}', 'AgencyController@sort');
		});
		Route::group(['prefix' => 'gender'],function(){
			Route::get('/','GenderController@index');
			Route::get('create','GenderController@create' );
			Route::post('store', 'GenderController@store');
			Route::get('{id}/edit', 'GenderController@edit');
			Route::post('{id}/update', 'GenderController@update');
			Route::get('{id}/destroy', 'GenderController@destroy');
			Route::get('{id}', 'GenderController@show');
			Route::post('status/{id}','GenderController@status');
			Route::post('sort/{id}', 'GenderController@sort');
		});
		Route::group(['prefix' => 'profession'],function(){
			Route::get('/','ProfessionController@index');
			Route::get('create','ProfessionController@create' );
			Route::post('store', 'ProfessionController@store');
			Route::get('{id}/edit', 'ProfessionController@edit');
			Route::post('{id}/update', 'ProfessionController@update');
			Route::get('{id}/destroy', 'ProfessionController@destroy');
			Route::get('{id}', 'ProfessionController@show');
			Route::post('status/{id}','ProfessionController@status');
			Route::post('sort/{id}', 'ProfessionController@sort');
		});
	});
	Route::group(['prefix' => 'idol'],function(){
		Route::get('/','IdolController@index');
		Route::get('create','IdolController@create' );
		Route::post('store', 'IdolController@store');
		Route::get('{id}/edit', 'IdolController@edit');
		Route::post('{id}/update', 'IdolController@update');
		Route::get('{id}/destroy', 'IdolController@destroy');
		Route::get('{id}', 'IdolController@show');
		Route::post('status/{id}','IdolController@status');
		Route::post('sort/{id}', 'IdolController@sort');
	});
	Route::group(['prefix' => 'idolclient'],function(){
		Route::get('/','IdolClientController@index');
	});
});


