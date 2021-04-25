<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/', 'LoginController@login');
Route::get('/logout', 'LoginController@logout');
Route::post('/login', 'LoginController@postlogin');
Route::get('/forgotpassword/{user}', 'LoginController@forgotpassword');
Route::post('/postforgotpassword/{user}', 'LoginController@postforgotpassword');
Route::get('/emailforgotpassword', 'LoginController@emailforgotpassword');
Route::post('/postemailforgotpassword', 'LoginController@postemailforgotpassword');

Route::get('/tes', 'Controller@tes');
Route::get('/sip', 'Controller@sip');

Route::group(['middleware' => ['auth', 'checkRole:admin,owner,superadmin']], function () {
    Route::get('/home', 'DashboardController@index');
    Route::get('/storages/edit/{storage}', 'StorageController@editstorage');
    Route::post('/updatestorage/{storage}', 'StorageController@updatestorage');

    Route::get('/unit/{id}', 'UnitController@index');
    Route::get('/box/{id}', 'BoxController@index');

    Route::get('/profile/{user}', 'UserController@profile');
    Route::post('/editprofile/{user}', 'UserController@editprofile');
});


Route::group(['middleware' => ['auth', 'checkRole:admin,superadmin']], function () {
    //Storage
    Route::get('/storages', 'DashboardController@storage');
    Route::get('/storages/deletestorage/{storage}', 'StorageController@deletestorage');
    Route::post('/createstorage', 'StorageController@createstorage');
    Route::get('/exportStorage', 'StorageController@exportStorage');

    //Unit
    Route::get('/unit/delete/{unit}', 'UnitController@delete');
    Route::get('/unit/edit/{unit}', 'UnitController@edit');
    Route::post('/unit/update/{unit}', 'UnitController@update');
    Route::post('/unit/create/{id}', 'UnitController@create');

    //Detail
    Route::get('/detail', 'StorageController@detail');
    Route::get('/detail/edit/{detail}', 'StorageController@editdetail');
    Route::get('/deletedetail/{detail}', 'StorageController@deletedetail');
    Route::post('/detail/update/{detail}', 'StorageController@updatedetail');
    Route::post('/createdetail', 'StorageController@createdetail');

    //Box
    Route::get('/box/delete/{box}', 'BoxController@delete');
    Route::get('/box/edit/{box}', 'BoxController@edit');
    Route::post('/box/update/{box}', 'BoxController@update');
    Route::post('/box/create/{id}', 'BoxController@create');


    //User 
    Route::get('/user', 'DashboardController@user');
    Route::get('/user/edit/{user}', 'UserController@edit');
    Route::post('/user/update/{user}', 'UserController@update');
    Route::post('/createowner', 'UserController@createowner');
    Route::get('/deleteuser/{user}', 'UserController@delete');

    //Promo
    Route::get('/promo', 'PromoController@index');
    Route::post('/createpromo', 'PromoController@create');
    Route::get('/promo/delete/{promo}', 'PromoController@delete');
    Route::get('/promo/{promo}', 'PromoController@edit');
    Route::post('/promo/update/{promo}', 'PromoController@update');
});

Route::group(['middleware' => ['auth', 'checkRole:owner']], function () {
    Route::get('/storages/{storage}', 'DashboardController@mystorage');
});

Route::group(['middleware' => ['auth', 'checkRole:superadmin']], function () {
    Route::get('/admin', 'UserController@admin');
    Route::post('/create/admin', 'UserController@createadmin');
    Route::get('/edit/admin/{admin}', 'UserController@editadmin');
    Route::post('/update/admin/{admin}', 'UserController@updateadmin');
    Route::get('/delete/admin/{admin}', 'UserController@deleteadmin');
});
