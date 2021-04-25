<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');
Route::post('forgotpassword', 'API\UserController@mailforgotpassword');

Route::group(['middleware' => 'auth:api'], function () {
    //User
    Route::get('user/detail', 'API\UserController@details');
    Route::post('logout', 'API\UserController@logout');
    Route::put('user/update', 'API\UserController@update');

    //List Transaction
    Route::get('/listOnGoing', 'API\TransactionController@listOnGoing');
    Route::get('/listHistory', 'API\TransactionController@listHistory');
    Route::get('/transaction/{transaction}', 'API\TransactionController@detail');

    //Transaction
    Route::post('/search', 'API\StorageController@search');
    Route::get('/storage/{storage}', 'API\StorageController@detail');
    Route::post('/box', 'API\StorageController@box');
    Route::post('/unit', 'API\StorageController@unit');
    Route::post('/create/transaction', 'API\TransactionController@create');

    //Promo
    Route::get('/promo/list', 'API\PromoController@list');
    Route::get('/promo/{promo}', 'API\PromoController@detail');
    Route::get('/searchPromo/{promo}', 'API\PromoController@search');

    //Review
    Route::post('/review/create', 'API\ReviewController@create');
    Route::get('/review/list/{storage}', 'API\ReviewController@list');

    //Storage
    Route::post('/storage/edit', 'API\StorageController@edit');

    //Recomendation
    Route::get('/recommendation', 'API\StorageController@recommendation');

    //Payment
    Route::post('/payment', 'API\PaymentController@payment');
});
