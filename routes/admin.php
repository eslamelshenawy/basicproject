<?php

/*
|--------------------------------------------------------------------------
| admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



    // to return login page
    Route::get('/Loginpage', 'Admin\LoginController@Loginpage')->name('Loginpage');
    Route::post('/submitLogin', 'Admin\LoginController@Login')->name('submitLogin');

    // to return other pages if he auth
    Route::group(['middleware' => 'auth'], function () {

        // return dashboard
        Route::get('/admin', 'Admin\HomeController@index')->name('admin');

    });

