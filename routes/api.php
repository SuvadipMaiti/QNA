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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/register/submit','User\Auth\LoginApiController@register_submit')->name('user_register_submit');
Route::post('/login/submit','User\Auth\LoginApiController@login_submit')->name('user_login_submit');




Route::get('/','User\Home\HomeApiController@index')->name('user_home');
// Route::get('/','User\Home\HomeApiController@index')->name('user_home')->middleware('auth.basic');
Route::get('/question/details/{slug}','User\Home\HomeApiController@question')->name('user_question');
Route::get('/question/answer/check/{slug}','User\Home\HomeApiController@correct_ans_check')->name('correct_ans_check');
