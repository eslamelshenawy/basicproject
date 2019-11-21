<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

    // 
    Route::post('login', 'Api\AuthController@login');
    Route::post('register', 'Api\AuthController@register');
    Route::post('check_verify', 'Api\AuthController@check_verify');


    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });

    // group of orders api
    Route::group(['middleware'=>'auth:api','prefix'=>'Order'],function(){
        Route::get('/','Api\OrderController@orders');
        Route::post('CaptainAcceptOrder','Api\OrderController@CaptainAcceptOrder');
        Route::post('CaptainReceivedOrder','Api\OrderController@CaptainReceivedOrder');
        Route::post('CreatOrder','Api\OrderController@CreatOrder');

    });
