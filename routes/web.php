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
|test
*/


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/post/{post}', 'PostController@show')->name('post');

Route::middleware(['auth', 'admin'])->group(function(){

    Route::get('/admin/posts/create', 'PostController@create')->name('post.create');
    Route::post('/admin/posts', 'PostController@store')->name('post.store');

    Route::get('/users', 'UserController@index')->name('users.index');

    Route::get('/blacklist', 'BlacklistUserController@index')->name('blacklist.index');
    Route::post('/blacklist/store', 'BlacklistUserController@store')->name('blacklist.store');
    Route::get('/blacklist/user/{id}', 'BlacklistUserController@editUser');
    Route::post('/blackupdate/user/{id}', 'BlacklistUserController@updateUser')->name('blackuser.update');
    Route::get('/blacklist/{id}', 'BlacklistUserController@destroy');
    Route::get('/export/blacklist', 'ExportController@blacklist');
    Route::post('/import/blacklist', 'BlacklistUserController@uploadContent')->name('file.upload');

    Route::get('/change/usertype/{id}', 'UserController@changeUsertype');


    Route::get('sendmail/{id}', 'SendMailController@testMail')->name('sendmail');
    
});


Route::middleware(['auth'])->group(function(){

    Route::get('/admin', 'AdminsController@index')->name('admin.index');
    Route::get('/userprofile', 'UserprofileController@userprofile');
    Route::post('/userprofile', 'UserprofileController@updateProfile')->name('update.profile');


    });

Route::get('test', 'GmailController@test');    
Route::get('gmailprofile', 'GmailController@getProfile');    

Route::get('google/login/url', 'GmailController@getAuthUrl');
Route::get('client', 'GmailController@getClient');

