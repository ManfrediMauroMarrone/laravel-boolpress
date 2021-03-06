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

Route::get('/', 'HomeController@index')->name('index');

Route::get('/contatti', 'HomeController@contatti')->name('contatti');

Route::get('/posts', 'PostController@index')->name('posts.index');

Route::get('/posts/{slug}','PostController@show')->name('posts.show');

Route::get('/categories/{slug}','CategoryController@show')->name('categories.show');

// rimuovo la possibilità di fare login
Auth::routes(['register' => false]);


// creo un gruppo di rotte con delle caratteristiche in comune
Route::middleware('auth')->namespace('admin')->prefix('admin')->name('admin.')->group(function(){

  Route::get('/', 'HomeController@index')->name('index');
  Route::resource('/posts', 'PostController');
  Route::get('/account', 'HomeController@account')->name('account');
  Route::post('/account/generate-token', 'HomeController@generateToken')->name('generate_token');
});
