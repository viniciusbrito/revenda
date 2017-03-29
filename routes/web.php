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

Route::get('/', ['as' =>'home', 'uses' => 'HomeController@index']);

/*Creating routes for Auth*/
Auth::routes();

Route::get('/home', ['as' =>'dash', 'uses' => 'HomeController@index']);

Route::group(['prefix' => 'admin'], function(){

    Route::group(['prefix' => 'login', 'namespace' => 'Auth'], function(){

        Route::get('/', [
            'as' => 'admin.login',
            'uses' => 'AdminLoginController@showLogin'
        ]);

        Route::post('/', [
            'as' => 'admin.login.submit',
            'uses' => 'AdminLoginController@login'
        ]);
    });

    Route::get('/logout', [
        'as' => 'admin.logout',
        'uses' => 'Auth\AdminLoginController@logout'
    ]);

    Route::group(['prefix' => 'password', 'namespace' => 'Auth'], function(){

        /*Forgot password*/
        Route::post('/email', [
            'as' => 'admin.password.email',
            'uses' => 'AdminForgotPasswordController@sendResetLinkEmail'
        ]);

        Route::get('/reset', [
            'as' => 'admin.password.request',
            'uses' => 'AdminForgotPasswordController@showLinkRequestForm'
        ]);

        /*Reset password*/
        Route::post('/reset', [
            //'as' => 'admin.passord.request.submit',
            'uses' => 'AdminResetPasswordController@reset'
        ]);

        Route::get('/reset/{token}', [
            'as' => 'admin.passord.reset',
            'uses' => 'AdminResetPasswordController@showResetForm'
        ]);
    });

    Route::get('/', [
        'as' => 'admin.dashboard',
        'uses' => 'Admin\AdminController@index'
    ]);
});
