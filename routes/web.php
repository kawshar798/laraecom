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

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'  =>  'admin'], function () {

    Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\LoginController@login')->name('admin.login.post');
    Route::get('logout', 'Admin\LoginController@logout')->name('admin.logout');


    Route::group(['middleware'=>'auth:admin','namespace'=>'Admin'],function (){
        Route::get('/','AdminController@index');

        Route::group(['prefix'=>'category'],function(){
            Route::get('/','CategoryController@index')->name('category.index');
            Route::any('create','CategoryController@create')->name('category.create');
            Route::any('edit/{id}','CategoryController@edit')->name('category.edit');
            Route::any('active/{id}','CategoryController@active')->name('category.active');
            Route::any('inactive/{id}','CategoryController@inactive')->name('category.inactive');
            Route::any('delete/{id}','CategoryController@destroy')->name('category.destroy');
            
        });

        Route::group(['prefix'=>'brand'],function(){
            Route::get('/','BrandController@index')->name('brand');
            Route::post('/store','BrandController@store')->name('brand.store');
            Route::any('active/{id}','BrandController@active')->name('brand.active');
            Route::any('inactive/{id}','BrandController@inactive')->name('brand.inactive');
            Route::any('delete/{id}','BrandController@destroy')->name('brand.destroy');
           
        });

    
    });

});
