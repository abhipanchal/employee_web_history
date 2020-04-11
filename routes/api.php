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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('setEmployee', 'API\EmployeeController@store');

Route::get('getEmployee/{ip_address}', 'API\EmployeeController@getEmployee');
Route::get('deleteEmployee/{ip_address}', 'API\EmployeeController@destroyEmployee');

Route::post('setWebHistory', 'API\EmployeeWebHistoryController@setHistory');
Route::get('getWebHistory/{ip_address}', 'API\EmployeeWebHistoryController@getEmployeeWebHistory');
Route::get('deleteWebHistory/{ip_address}', 'API\EmployeeWebHistoryController@destroyEmployeeWebHistory');
