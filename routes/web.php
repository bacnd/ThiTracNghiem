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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::group(['middleware' => 'auth', 'prefix' => 'posts'], function() {

	Route::get('/', 'PostsController@index');

	Route::group(['middleware' => 'admin:admin'], function() {
		Route::get('/create', 'PostsController@create')->name('posts.create');
	});

	Route::post('/store', 'PostsController@store')->name('posts.store');
	Route::get('/{id}', 'PostsController@show')->name('posts.show');
	Route::post('/check', 'PostsController@check')->name('posts.check');

});

Route::group(['prefix' => 'category'], function() {

	Route::get('/{id}', 'CategoriesController@show')->name('cat.show');

});

Route::group(['middleware' => 'auth', 'prefix' => 'exam-results'], function() {

	Route::get('/', 'ExamResultsController@index')->name('er.index');
	Route::post('/create', 'ExamResultsController@store')->name('er.store');

});

Route::get('/exam-results/user-score', 'ExamResultsController@userscore')->name('er.userscore');

Route::get('/user/{id}', 'UsersController@show');

Route::group(['middleware' => ['auth', 'admin:admin'], 'prefix' => 'admins'], function() {

	Route::get('/', 'AdminController@index')->name('admin.index');
	Route::get('/posts', 'AdminController@posts')->name('admin.posts');
	Route::get('/categories', 'AdminController@categories')->name('admin.categories');

	Route::get('/categories/create', 'CategoriesController@create')->name('cat.create');

	Route::post('/categories/store', 'CategoriesController@store')->name('cat.store');

	Route::get('/users', 'AdminController@users')->name('admin.users');
	Route::get('/users/create', 'UsersController@create')->name('users.create');
	Route::post('/users/store', 'UsersController@store')->name('users.store');

});