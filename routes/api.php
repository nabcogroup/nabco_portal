<?php

//header('Access-Control-Allow-Origin: *');
//header('Access-Control-Allow-Headers: Origin,Content-Type,Authorization,X-Auth-Token');
//header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH,DELETE, HEAD, OPTIONS');

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


Route::post('login',"Api\Auth\LoginController@login");

Route::middleware('auth:api')->get('/user', function (Request $request) {

    return $request->user();

});



Route::group(['prefix' => 'request','middleware' => 'auth:api'],function() {

    Route::get('/create',"Api\RequestController@create");

    Route::get('/show',"Api\RequestController@show");

    Route::get('/',"Api\RequestController@index");

    Route::post('/store',"Api\RequestController@store");



});

Route::group(['prefix' => 'employee','middleware' => 'auth:api'],function() {

    Route::get('/',"Api\EmployeeController@index");
    
});

