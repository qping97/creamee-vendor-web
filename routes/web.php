<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductCategoryController;
use Illuminate\Support\Facades\Auth;
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
Route::get('/', function () {
    return view('welcome');
});

Route::get('login/admin', 'Auth\LoginController@showAdminLoginForm')->name('adminLogin');
Route::post('login/admin', 'Auth\LoginController@adminLogin');

Route::post('logout/admin', 'Auth\LoginController@logoutAdmin')->name('admin.logout');
Route::get('register/admin', 'Auth\RegisterController@showAdminRegisterForm')->name('adminRegister');;
Route::post('register/admin', 'Auth\RegisterController@createAdmin');

Route::get('dashboard', 'Admin\AdminController@index');
Route::get('vendor-list', 'Admin\AdminController@vendor');
Route::get('vendor-list/view/{id}', 'Admin\AdminController@getVendor');
Route::get('customer-list', 'Admin\AdminController@customer');
Route::get('customer-list/view/{id}', 'Admin\AdminController@getCustomer');
Route::get('profile', 'Admin\AdminController@getprofile');
Route::post('adminprofile-update', 'Admin\AdminController@updateAdminprofile');

Route::get('login/vendor', 'Auth\LoginController@showVendorLoginForm')->name('vendorLogin');
Route::post('login/vendor', 'Auth\LoginController@vendorLogin');
Route::post('logout/vendor', 'Auth\LoginController@logoutVendor')->name('vendor.logout');
# open vendor page after login

Route::get('register/vendor', 'Auth\RegisterController@showVendorRegisterForm')->name('vendorRegister');
Route::post('register/vendor', 'Auth\RegisterController@createVendor');

Route::get('product-category', 'Vendor\ProductCategoryController@index')->name('category.index');
Route::post('product-category/store', 'Vendor\ProductCategoryController@store');
Route::post('product-category/update/{id}', 'Vendor\ProductCategoryController@update'); 
Route::get('product-category/edit/{id}', 'Vendor\ProductCategoryController@edit');
Route::get('product-category/delete/{id}', 'Vendor\ProductCategoryController@destroy');

Route::get('product', 'Vendor\ProductController@index')->name('product-index');
Route::post('product/store', 'Vendor\ProductController@store');
Route::post('product/update/{id}', 'Vendor\ProductController@update');
Route::get('product/edit/{id}', 'Vendor\ProductController@edit');
Route::get('product/delete/{id}', 'Vendor\ProductController@destroy');

Route::get('vendor/custom-cake/size', 'Vendor\CustomcakeController@getSize')->name('custom-size');
Route::post('vendor/custom-cake/size/store', 'Vendor\CustomcakeController@storeSize');
Route::post('vendor/custom-cake/size/update/{id}', 'Vendor\CustomcakeController@updateSize');
Route::get('vendor/custom-cake/size/edit/{id}', 'Vendor\CustomcakeController@editSize');
Route::get('vendor/custom-cake/size/delete/{id}', 'Vendor\CustomcakeController@destroySize');

Route::get('vendor/custom-cake/flavor', 'Vendor\CustomcakeController@getFlavor')->name('custom-flavor');
Route::post('vendor/custom-cake/flavor/store', 'Vendor\CustomcakeController@storeFlavor');
Route::post('vendor/custom-cake/flavor/update/{id}', 'Vendor\CustomcakeController@updateFlavor');
Route::get('vendor/custom-cake/flavor/edit/{id}', 'Vendor\CustomcakeController@editFlavor');
Route::get('vendor/custom-cake/flavor/delete/{id}', 'Vendor\CustomcakeController@destroyFlavor');

Route::get('vendor/profile', 'Vendor\VendorController@getprofile')->name('vendorProfile');
Route::post('myprofile-update','Vendor\VendorController@updateProfile');
Route::get('vendor/order-list', 'Vendor\VendorController@orders')->name('vendor-order');
Route::get('vendor/order-details/{id}', 'Vendor\VendorController@getOrderDetails');
Route::get('vendor/custom-order-list', 'Vendor\VendorController@customOrders')->name('vendor-custom-order');
Route::get('vendor/custom-order-details/{id}', 'Vendor\VendorController@getcustomDetail');
Route::post('vendor/orderstatus-update/{id}','Vendor\VendorController@updateOrderStatus');

// Route::post('register/customer', 'Auth\RegisterController@createCustomer')->name('customerLogin');;
// Route::post('login/customer', 'Auth\LoginController@customerLogin');
// Route::post('logout/customer', 'Auth\LoginController@logoutCustomer');


//Route::view('/home', 'home')->middleware('auth');
Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('/admin/dashboard', 'Admin\AdminController@index')->name('admin.dashboard');
    Route::get('/vendor/isblocked/{id}/{val}','Admin\AdminController@vendorIsBlocked');
});

Route::group(['middleware' => 'auth:vendor'], function () {
    Route::get('/vendor/dashboard', 'Vendor\VendorController@dashboard')->name('vendor-dashboard');
    
});


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
