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

Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {
        Route::get('publisher/export', 'PublisherController@export')->name('publisher.export');
        Route::get('search-user', 'UserController@search')->name('search-user');
        Route::resource('user', 'UserController');
        Route::resource('author', 'AuthorController');
        Route::resource('publisher', 'PublisherController');
        Route::resource('category', 'CategoryController');
        Route::resource('book', 'BookController');
        Route::get('search-book', 'BookController@search')->name('search-book');
        Route::get('category-popup', 'BookController@catePopup')->name('category-popup');
    });
    Route::resource('/', 'ClientController');
    Route::get('home', 'HomeController@index')->name('home');
});
