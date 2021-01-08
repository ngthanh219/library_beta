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
    Route::group(['middleware' => 'admin', 'prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {
        Route::get('publisher/export', 'PublisherController@export')->name('publisher.export');
        Route::get('search-user', 'UserController@search')->name('search-user');
        Route::resource('role', 'RoleController');
        Route::resource('user', 'UserController');
        Route::resource('author', 'AuthorController');
        Route::resource('publisher', 'PublisherController');
        Route::resource('category', 'CategoryController');
        Route::resource('book', 'BookController');
        Route::get('search-book', 'BookController@search')->name('search-book');
        Route::get('category-popup', 'BookController@catePopup')->name('category-popup');
        Route::post('api-store-category', 'CategoryController@apiStore')->name('api-store-category');
        Route::get('dashboard', 'HomeController@index')->name('dashboard');
        Route::get('request', 'RequestController@index')->name('request');
        Route::get('request-detail/{request}', 'RequestController@show')->name('request-detail');
        Route::get('accept/{request}', 'RequestController@accept')->name('accept');
        Route::get('reject/{request}', 'RequestController@reject')->name('reject');
    });
    Route::post('request', 'RequestController@request')->name('request');
});

Route::get('/', 'BookController@index')->name('home');
Route::get('category-book/{categoryId}', 'BookController@cateBook')->name('category-book');
Route::get('detail/{book}', 'BookController@detail')->name('detail');
Route::get('cart', 'RequestController@cart')->name('cart');
Route::get('add-cart/{book}', 'RequestController@addToCart')->name('add-cart');
Route::get('remove-cart/{book}', 'RequestController@removeCart')->name('remove-cart');
Route::get('react/{book}', 'ReactionController@react')->name('react');
