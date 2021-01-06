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
        Route::get('detail','IdolController@detail');
    });

    Route::get('login/google', function () {
        return view('googleAuth');
    });
    
    // Route::get('/auth/google', 'Auth\LoginController@redirectToGoogle');
    // Route::get('/auth/google/callback', 'Auth\LoginController@handleGoogleCallback');
    
    Route::get('auth/redirect/{provider}', 'SocialController@redirect');
    Route::get('callback/{provider}', 'SocialController@callback');
});

