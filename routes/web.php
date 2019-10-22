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


Route::post('/login/admin', 'Auth\LoginController@adminLogin')->name('login.admin');
Route::post('/register/admin', 'Auth\RegisterController@createAdmin');

Route::get('send-mail', 'MailSend@mailsend');
Route::get('/my-article', 'UserController@articles')->name('users.articles');
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
Route::put('/admin/{article}', 'ArticleController@statusUpdate')->name('admin.update');


// Using Yajra data Tables
Route::get('users-list', 'UserController@usersList'); 
Route::get('users-table', 'UserController@yajraIndex'); 
Route::get('article-list', 'ArticleController@articlesAdmin');
Route::get('article/status', 'ArticleController@indexAdmin');


// get Article with approved status
Route::get('homepage', 'ArticleController@indexApproved');


// to view article with status
Route::get('/article-rejected', 'ArticleController@indexRejected');
Route::get('/article-pending', 'ArticleController@indexPending');

