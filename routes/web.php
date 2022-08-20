<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Middleware\UserCheckMiddleware;
use App\Http\Middleware\AdminCheckMiddleware;
use App\Http\Controllers\Admin\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'])->get('/dashboard',function(){
        if(Auth::check()){
            if(Auth::user()->role=='admin'){
                return redirect()->route('admin#profile');
            }else if(Auth::user()->role == 'user'){
                return redirect()->route('user#index');
            }
        }
    })->name('dashboard');

  Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>[AdminCheckMiddleware::class]],function(){
    //AdminController
     Route::get('profile','AdminController@profile')->name('admin#profile');
     Route::get('login','AdminController@login')->name('admin#login');
     Route::post('update/{id}','AdminController@updateProfile')->name('admin#updateProfile');
     Route::get('changePassword','AdminController@changePasswordPage')->name('admin#changePasswordPage');
     Route::post('changePassword/{id}','AdminController@changePassword')->name('admin#changePassword');
    //CategoryController
     Route::get('category','CategoryController@category')->name('admin#category');
     Route::get('addCategory','CategoryController@addCategory')->name('admin#addCategory');
     Route::post('createCategory','CategoryController@createCategory')->name('admin#createCategory');
     Route::get('deleteCategory/{id}','CategoryController@deleteCategory')->name('admin#deleteCategory');
     Route::get('editCategory/{id}','CategoryController@editCategory')->name('admin#editCategory');
     Route::post('updateCategory','CategoryController@updateCategory')->name('admin#updateCategory');
     Route::get('category/search','CategoryController@searchCategory')->name('admin#searchCategory');
     Route::get('categoryItem/{id}','PizzaController@categoryItem')->name('admin#categoryItem');
     Route::get('category/download','CategoryController@categoryDownload')->name('admin#categoryDownload');
     //PizzaController 
     Route::get('pizza','PizzaController@pizza')->name('admin#pizza');
     Route::get('createPizza','PizzaController@createPizza')->name('admin#createPizza');
     Route::post('insertPizza','PizzaController@insertPizza')->name('admin#insertPizza');
     Route::get('deletePizza/{id}','PizzaController@deletePizza')->name('admin#deletePizza');
     Route::get('pizzaInfo/{id}','PizzaController@pizzaInfo')->name('admin#pizzaInfo');
     Route::get('editPizza/{id}','PizzaController@editPizza')->name('admin#editPizza');
     Route::post('updatePizza/{id}','PizzaController@updatePizza')->name('admin#updatePizza');
     Route::get('pizza/search','PizzaController@searchPizza')->name('admin#searchPizza');
     Route::get('pizza/download','PizzaController@pizzaDownload')->name('admin#pizzaDownload');
     //UserController
     Route::get('adminList','UserController@adminList')->name('admin#adminList');
     Route::get('userList','UserController@userList')->name('admin#userList');
     Route::get('userList/search','UserController@userSearch')->name('admin#userSearch');
     Route::get('userList/delete/{id}','UserController@userDelete')->name('admin#userDelete');
     Route::get('admin/search','UserController@adminSearch')->name('admin#adminSearch');
     Route::get('adminList/download','UserController@adminListDownload')->name('admin#adminListDownload');
     Route::get('userList/download','UserController@userListDownload')->name('admin#userListDownload');
    //ContactController
     Route::get('contact/list','ContactController@contactList')->name('admin#contactList');
     Route::get('contact/search','ContactController@contactSearch')->name('admin#contactSearch');
     Route::get('contact/download','ContactController@contactDownload')->name('admin#contactDownload');
    //OrderController
     Route::get('order/list','OrderController@orderList')->name('admin#orderList');
     Route::get('order/search','OrderController@orderSearch')->name('admin#orderSearch');
     Route::get('order/download','orderController@orderDownload')->name('admin#orderDownload');
  });

  Route::group(['prefix'=>'user','middleware'=>[UserCheckMiddleware::class]],function(){
    Route::get('profile','UserController@profile')->name('user#profile');
    Route::get('/','UserController@index')->name('user#index');

     Route::get('pizza/details/{id}','UserController@pizzaDetails')->name('user#pizzaDetails');
     Route::get('category/search/{id}','UserController@categorySearch')->name('user#categorySearch');
     Route::get('search/item','UserController@searchItem')->name('user#searchItem');
     Route::get('search/pizzaItem','UserController@searchPizzaItem')->name('user#searchPizzaItem');
     //Contact
    Route::post('contact/create','Admin\ContactController@createContact')->name('user#createContact');
    //Order
    Route::get('order','UserController@order')->name('user#order');
    Route::post('order','UserController@placeOrder')->name('user#placeOrder');
  });
