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

/*
Route::get('skills', 'Api\SkillController@index');
Route::post('skills', 'Api\SkillController@store');
Route::put('skills/{id}', 'Api\SkillController@update');
Route::delete('skills/{id}', 'Api\SkillController@destroy');
*/

Route::post('auth', 'Auth\AuthApiController@authenticate');
Route::get('auth-refresh', 'Auth\AuthApiController@refreshToken');
Route::get('me', 'Auth\AuthApiController@getAuthenticatedUser');

Route::group([
   'prefix' => 'v1',
   'namespace' => 'Api\v1',
   //'middleware' => 'auth:api'
], function () {
   Route::apiResource('skills', 'SkillController');
   Route::delete('skills/delete/{ids}', 'SkillController@destroyAll');  
});
