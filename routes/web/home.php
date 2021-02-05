<?php 
Route::group([ 'namespace' => 'Home'], function() {
    Route::get('/','HomeController@index');
    Route::get('public/home','HomeController@index');
    Route::get('category/{slug}','HomeController@category');
    Route::get('category/{cat}/{slug}','HomeController@categoryChild');
    
    Route::get('{slug}','HomeController@post');
    Route::get('load/feed/{slug}','HomeController@feed');
    Route::get('load/more','HomeController@getLoadmore');

    Route::get('subscribe/form','HomeController@getSubscribe');
    Route::post('subscribe/send','HomeController@postSubscribe');

    Route::post('search','HomeController@postSearch');

    Route::group(['prefix' => 'page'],function(){
        Route::get('about','HomeController@getAbout');
        Route::get('advertisement','HomeController@getAdvertisement');
        Route::get('error','HomeController@getError');
    });

    Route::group(['prefix' => 'idol'], function () {
        Route::get('statistic','IdolController@index');
        Route::get('ranking','IdolController@ranking');
        Route::get('list','IdolController@list');
        Route::get('detail/{id}','IdolController@detail');
        Route::get('vote/{id}','IdolController@vote');
        Route::get('like/{id}','IdolController@like');
        
    });

    Route::group(['prefix' => 'logauth'], function () {
        Route::get('signup','LogAuthController@getSignup');
        Route::post('signup','LogAuthController@postSignup');
        Route::post('login','LogAuthController@postLogin');
        Route::get('logout','LogAuthController@logout');

        Route::get('info/{id}','LogAuthController@info');
        Route::post('info/changepassword/{id}','LogAuthController@changePassWord');
        
    });
    Route::get('auth/redirect/{provider}', 'SocialController@redirect');
    Route::get('callback/{provider}', 'SocialController@callback');
});

