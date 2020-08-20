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

Auth::routes(['verify' => true]);


Route::get('/', 'HomeController@fontendShow')->name('/');
Route::get('logout', 'Auth\LoginController@logout')->name('admin.logout');
Route::post('user/register', 'Auth\RegisterController@userRegister')->name('user.register');
Route::any('email/verify', 'Auth\RegisterController@varifyEmail')->name('email.verify');
Route::get('register',function (){
    return redirect()->to('login');
});

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
        //Get all sub Category
        Route::any('get/subcategory/{id}','CategoryController@getSubCategory')->name('subcategory');

        //Brand Route
        Route::group(['prefix'=>'brand'],function(){
            Route::get('/','BrandController@index')->name('brand');
            Route::post('/store','BrandController@store')->name('brand.store');
            Route::any('active/{id}','BrandController@active')->name('brand.active');
            Route::any('inactive/{id}','BrandController@inactive')->name('brand.inactive');
            Route::any('delete/{id}','BrandController@destroy')->name('brand.destroy');

        });

        //Product Route
        Route::group(['prefix'=>'product'],function(){
            Route::get('/','ProductController@index')->name('product');
            Route::get('/create','ProductController@create')->name('product.create');
            Route::post('/store','ProductController@store')->name('product.store');
            Route::get('/edit/{id}','ProductController@edit')->name('product.edit');
            Route::post('/update/','ProductController@update')->name('product.update');
            Route::any('active/{id}','ProductController@active')->name('product.active');
            Route::any('inactive/{id}','ProductController@inactive')->name('product.inactive');
            Route::any('delete/{id}','ProductController@destroy')->name('product.destroy');

        });


        //Coupon Route
        Route::group(['prefix'=>'coupon'],function(){
            Route::get('/','CouponController@index')->name('coupon');
            Route::post('/store','CouponController@store')->name('coupon.store');
            Route::any('active/{id}','CouponController@active')->name('coupon.active');
            Route::any('inactive/{id}','CouponController@inactive')->name('coupon.inactive');
            Route::any('delete/{id}','CouponController@destroy')->name('coupon.destroy');

        });

        //Newsletter Route
        Route::group(['prefix'=>'newsletter'],function(){
            Route::get('/','NewsLetterController@index')->name('newsletter');
            Route::any('delete/{id}','NewsLetterController@destroy')->name('newsletter.destroy');
        });

        //Post Category Route
        Route::group(['prefix'=>'post/category'],function(){
            Route::get('/','PostCategoryController@index')->name('post.category.index');
            Route::post('/store','PostCategoryController@store')->name('post.category.store');
            Route::any('active/{id}','PostCategoryController@active')->name('post.category.active');
            Route::any('inactive/{id}','PostCategoryController@inactive')->name('post.category.inactive');
            Route::any('delete/{id}','PostCategoryController@destroy')->name('post.category.destroy');

        });
         //Post Route
         Route::group(['prefix'=>'post'],function(){
            Route::get('/','PostController@index')->name('post.index');
            Route::post('/store','PostController@store')->name('post.store');
            Route::any('active/{id}','PostController@active')->name('post.active');
            Route::any('inactive/{id}','PostController@inactive')->name('post.inactive');
            Route::any('delete/{id}','PostController@destroy')->name('post.destroy');

        });


    });

});


//User info

Route::group(['as'=>'user.','prefix'=>'user','middleware' => 'auth'],function (){

    Route::get('dashboard', 'HomeController@index')->name('home');
    Route::get('/order', 'HomeController@userOrder')->name('order');
    Route::get('/profile', 'HomeController@userProfile')->name('profile');
    Route::get('/address', 'HomeController@userAddress')->name('address');
    Route::any('/change-password', 'HomeController@userChangePassword')->name('chnagepass');
});


//Newsletter store for front-end
Route::post('/newsletter/store', 'HomeController@newsletterStore')->name('home');
Route::get('add/wishlist/{id}','WishlistController@addWishlist');
Route::get('add/cart/{id}','CartController@addToCart');
Route::get('check','CartController@check');
Route::get('product/details/{id}/{product_name}','ProductController@productDetails');
Route::post('product/add/cart/{id}','ProductController@productCartAdd');
Route::get('show/cart','CartController@showCart');
Route::get('remove/cart/{id}','CartController@removeCart');
Route::get('cart/product/view/{id}','CartController@cartProductView');
Route::post('update/cart/product','CartController@udpateCartProductQty');
Route::post('product/add/cart','CartController@addProductInCart');
Route::get('user/checkout','CartController@userCheckOut');
Route::get('user/wishlist','WishlistController@userWishlist');
Route::get('remove/product/wishlist/{id}','WishlistController@userWishlistRemove');
