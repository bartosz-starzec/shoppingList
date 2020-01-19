<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/products', 'ProductController@index');
Route::post('/products/create', 'ProductController@store');
Route::post('/products/update', 'ProductController@update');
Route::delete('/products/delete/{id}', 'ProductController@deleteMany');

Route::get('/shopping-lists', 'ShoppingListController@index');
Route::post('/shopping-lists/create', 'ShoppingListController@store');
Route::delete('/shopping-lists/delete/{id}', 'ShoppingListController@destroy');
Route::post('/shopping-lists/{id}/add-products', 'ShoppingListController@storeProducts');

Route::post('/shopping-lists/job-status', 'ShoppingListController@getJobStatus');

