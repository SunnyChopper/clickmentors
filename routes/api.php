<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('categories')->group(function() {
	// Categories
	Route::put('create', 'CategoriesController@create_category');
	Route::get('read', 'CategoriesController@read_category');
	Route::post('update', 'CategoriesController@update_category');
	Route::delete('delete', 'CategoriesController@delete_category');
	Route::get('get', 'CategoriesController@get_categories');

	// Category Content
	Route::put('content/create', 'CategoriesController@create_category_content');
	Route::get('content/read', 'CategoriesController@read_category_content');
	Route::get('content/get', 'CategoriesController@get_category_content');

	// User Category
	Route::put('users/create', 'CategoriesController@create_user_category');
	Route::get('users/read', 'CategoriesController@read_user_category');
	Route::post('users/update', 'CategoriesController@update_user_category');
	Route::delete('users/delete', 'CategoriesController@delete_user_category');
	Route::get('users/get', 'CategoriesController@get_user_categories');
});

Route::prefix('comments')->group(function() {
	// Content Comments
	Route::put('create', 'CommentsController@create_comment');
	Route::get('read', 'CommentsController@read_comment');
	Route::delete('delete', 'CommentsController@delete_comment');
	Route::get('get', 'CommentsController@get_comments');

	// Comment Replies
	Route::put('replies/create', 'CommentsController@create_comment_reply');
	Route::get('replies/read', 'CommentsController@read_comment_reply');
	Route::delete('replies/delete', 'CommentsController@delete_comment_reply');
	Route::get('replies/get', 'CommentsController@get_comment_replies');
});

Route::prefix('shop')->group(function() {
	// Shop Items
	Route::put('items/create', 'ShopItemsController@create_shop_item');
	Route::get('items/read', 'ShopItemsController@read_shop_item');
	Route::post('items/update', 'ShopItemsController@update_shop_item');
	Route::delete('items/delete', 'ShopItemsController@delete_shop_item');
	Route::get('get', 'ShopItemsController@get_shop_items');

	// Shop Item Orders
	Route::put('orders/create', 'ShopItemsController@create_comment');
	Route::get('orders/read', 'ShopItemsController@read_comment');
	Route::post('orders/update', 'ShopItemsController@update_comment');
	Route::delete('orders/delete', 'ShopItemsController@delete_comment');
	Route::get('orders/get', 'ShopItemsController@get_shop_item_orders');
});

Route::prefix('users')->group(function() {
	// Shop Item Orders
	Route::put('create', 'UsersController@create_user');
	Route::get('read', 'UsersController@read_user');
	Route::post('update', 'UsersController@update_user');
	Route::delete('delete', 'UsersController@delete_user');
	Route::get('get', 'UsersController@get_users');
	Route::post('login', 'UsersController@login');
});