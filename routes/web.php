<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Auth::routes(['verify' => true]);


Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm');
Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm');


Route::post('/login/admin', 'Auth\LoginController@adminLogin');
Route::post('/register/admin', 'Auth\RegisterController@createAdmin');

Route::get('send-mail', 'MailSend@mailsend');
Route::get('/articles-list', 'UserController@articles')->name('users.articles');
Route::get('/profile', 'UserController@profile')->name('users.profile');


Route::resource('users', 'UserController');
Route::resource('articles', 'ArticleController');

Route::get('/home', 'HomeController@index')->middleware('auth');

Route::get('/logout', function(){
    auth()->logout();
    Session()->flush();

    return Redirect::to('/');
})->name('logout');

// Admin Route
Route::view('/admin', 'admin');
// Using Yajra data Tables
Route::get('users-list', 'UserController@usersList'); 

