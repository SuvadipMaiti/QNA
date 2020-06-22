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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin/register','Admin\Auth\LoginController@register')->name('admin_register');
Route::post('/admin/register/submit','Admin\Auth\LoginController@register_submit')->name('admin_register_submit');
Route::get('/admin/login','Admin\Auth\LoginController@login')->name('admin_login');
Route::post('/admin/login/submit','Admin\Auth\LoginController@login_submit')->name('admin_login_submit');

Route::group(['prefix'=>'admin','middleware'=>  ['auth', 'CheckAdmintype'] ], function () {
    Route::get('/home','Admin\Home\HomeController@index')->name('admin_home');
    Route::post('/logout','Admin\Auth\LoginController@logout')->name('admin_logout');
    

    Route::get('/category/list','Admin\Home\CategoryController@index')->name('category_list');
    Route::post('/category/store','Admin\Home\CategoryController@store')->name('category_store');
    Route::get('/category/edit/{slug}','Admin\Home\CategoryController@edit')->name('category_edit');
    Route::post('/category/update/{slug}','Admin\Home\CategoryController@update')->name('category_update');
    Route::get('/category/destroy/{slug}','Admin\Home\CategoryController@destroy')->name('category_destroy');
    
    Route::get('/tag/list','Admin\Home\TagController@index')->name('tag_list');
    Route::post('/tag/store','Admin\Home\TagController@store')->name('tag_store');
    Route::get('/tag/edit/{slug}','Admin\Home\TagController@edit')->name('tag_edit');
    Route::post('/tag/update/{slug}','Admin\Home\TagController@update')->name('tag_update');
    Route::get('/tag/destroy/{slug}','Admin\Home\TagController@destroy')->name('tag_destroy');

});



Route::get('/','User\Home\HomeController@index')->name('user_home');
Route::get('/question/details/{slug}','User\Home\HomeController@question')->name('user_question');
Route::get('/question/answer/check/{slug}','User\Home\HomeController@correct_ans_check')->name('correct_ans_check');
Route::get('/register','User\Auth\LoginController@register')->name('user_register');
Route::post('/register/submit','User\Auth\LoginController@register_submit')->name('user_register_submit');
Route::get('/login','User\Auth\LoginController@login')->name('user_login');
Route::post('/login/submit','User\Auth\LoginController@login_submit')->name('user_login_submit');





Route::group(['middleware'=> ['auth', 'CheckUsertype'] ], function () {
    Route::get('/profile','User\Auth\LoginController@profile')->name('user_profile');
    Route::post('/logout','User\Auth\LoginController@logout')->name('user_logout');
    Route::post('/profile/update','User\Auth\LoginController@profile_update')->name('user_profile_update');
    Route::get('/question/post','User\Home\QuestionController@user_post_question')->name('user_post_question');
    Route::post('/question/submit','User\Home\QuestionController@user_submit_question')->name('user_submit_question');
    Route::post('/answer/submit','User\Home\QuestionController@user_answer_submit')->name('user_answer_submit');
    
    Route::get('/question/users','User\Home\HomeController@user_questions')->name('user_questions');
    Route::get('/question/users/edit/{slug}','User\Home\QuestionController@user_question_edit')->name('user_question_edit');
    Route::post('/question/users/edit/submit/{slug}','User\Home\QuestionController@user_edit_question')->name('user_edit_question');
    Route::get('/question/users/answer/edit/{slug}','User\Home\QuestionController@user_ans_edit')->name('user_ans_edit');
    Route::post('/question/users/answer/edit/submit/{slug}','User\Home\QuestionController@user_answer_edit_submit')->name('user_answer_edit_submit');
    
    
});

