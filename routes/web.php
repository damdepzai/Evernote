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

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/login-google','LoginSocialiteController@LoginGoogle')->name('login.google');
Route::get('/google-callback', 'LoginSocialiteController@loginGoogleCallback')->name('google.callback');
Route::get('/login-facebook','LoginSocialiteController@LoginFacebook')->name('login.facebook');
Route::get('/facebook-callback', 'LoginSocialiteController@loginFacebookCallback')->name('facebook.callback');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('{path}', function () {
    return view('home');
})->where('path', '^((?!api).)*$');
Route::prefix('api')->group(function () {
    Route::get('/logout', 'HomeController@Logout');
    Route::get('/me', 'HomeController@me');

    Route::group(['prefix'=>'note'],function(){
       Route::get('/list','NoteController@index');
       Route::post('/create','NoteController@store');
       Route::delete('/delete/{id}','NoteController@destroy');

    });
});
