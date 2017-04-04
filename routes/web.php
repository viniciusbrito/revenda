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

Route::get('/', 'HomeController@index')->name('home');

/*Creating Routes for Auth*/
Auth::routes();

/*Client's Routes*/
Route::group(['prefix' => 'client'], function() {

    /*Routes to client's panel*/
    Route::resource('/',
        'Client\ClientController',
        [
            'only' => ['index'],
            'names' => ['index' => 'client.index']
        ]);

    /*Routes to client's addres*/
    Route::resource('/address',
        'Client\EnderecoController',
        [
            'except' => ['index', 'show', 'destroy'],
            'as' => 'client'
        ]);

    /*Routes to client's accouts*/
    Route::resource('/account',
        'CPanel\ContaController',
        [
            'only' => ['create', 'store', 'show'],
            'as' => 'client'
        ]);

    Route::resource('/payment', 'Payment\PaymentController', ['only' => ['create', 'store'], 'as' => 'client']);

});

/*Admin's Routes*/
Route::group(['prefix' => 'admin'], function(){

    /*Routes to login*/
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

    /*Logout route*/
    Route::get('/logout', ['as' => 'admin.logout','uses' => 'Auth\AdminLoginController@logout']);

    /*Routes to send token and create new password*/
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

    /*Admin's Dashboard*/
    Route::get('/', ['as' => 'admin.dashboard', 'uses' => 'Admin\AdminController@index']);

    Route::resource('/user', 'Admin\Client\UserController', ['except' =>['destroy', 'index'], 'as' => 'admin']);

    Route::resource('/user/{user}/account', 'Admin\Client\AccountController', ['only' =>['create', 'store', 'show'], 'as' => 'admin']);

    Route::resource('/account/{account}/payment', 'Admin\Client\PaymentController', ['only' =>['create', 'store', 'update', 'index', 'show'], 'as' => 'admin']);
});
