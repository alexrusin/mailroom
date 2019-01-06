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

Auth::routes();

Route::get('/', 'HomeController@index')->name('root');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/verify', 'HomeController@verifyUser')->name('verify-user');
Route::post('/resend-verification-email', 'HomeController@resendVerificationEmail')->name('resend-verification-email');

Route::get('/hooks', 'HooksController@index')->name('hooks.index');
Route::get('/hooks/create', 'HooksController@create')->name('hooks.create');
Route::post('/hooks', 'HooksController@store')->name('hooks.store');
Route::delete('/hooks/{hook}', 'HooksController@destroy')->name('hooks.delete');



