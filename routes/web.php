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

Route::get('/','ArticlesController@index')->name('articles');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


Route::get('/articles', 'ArticlesController@index')->name('articles');
Route::get('/articles/publish', 'ArticlesController@publish')->name('articles.publish');
Route::post('/articles/store', 'ArticlesController@store')->name('articles.store');


//soft deletes/trashed routes.
Route::get('/articles/trash', 'ArticlesController@trash')->name('articles.trash');
Route::get('/articles/trash/{id}/restore', 'ArticlesController@restore')->name('articles.restore');
Route::delete('/articles/trash/{id}/permanent-delete', 'ArticlesController@permanentDelete')->name('articles.permanent-delete');



//admin routes.
Route::get('/dashboard', 'AdminController@index')->name('dashboard');
Route::get('/admin/articles', 'AdminController@articles')->name('admin.articles');





//paramater routes.
Route::get('/articles/{id}', 'ArticlesController@show')->name('articles.show');
Route::get('/articles/{id}/edit', 'ArticlesController@edit')->name('articles.edit');
Route::patch('/articles/{id}/update', 'ArticlesController@update')->name('articles.update');
Route::delete('/articles/{id}/delete', 'ArticlesController@delete')->name('articles.delete');



//Routes for categories
Route::get('/categories', 'CategoriesController@index')->name('categories.index');
Route::get('/categories/publish', 'CategoriesController@publish')->name('categories.publish');
Route::post('/categories/store', 'CategoriesController@store')->name('categories.store');
Route::get('/categories/{id}/edit', 'CategoriesController@edit')->name('categories.edit');
Route::get('/categories/{slug}', 'CategoriesController@show')->name('categories.show');
Route::patch('/categories/{id}/update', 'CategoriesController@update')->name('categories.update');
Route::delete('/categories/{id}/destroy', 'CategoriesController@destroy')->name('categories.destroy');




//Routes for admin user management
Route::get('/users', 'UserController@index')->name('admin.users');
Route::patch('/users/{id}/update', 'UserController@update')->name('users.update');
Route::delete('/users/{id}/destroy', 'UserController@destroy')->name('users.destroy');


Route::get('/authors/{id}', 'UserController@show')->name('authors.show');