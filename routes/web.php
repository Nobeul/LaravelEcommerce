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

Route::get('/', 'Frontend\PagesController@index')->name('index');
Route::get('/contact', 'Frontend\PagesController@contact')->name('contact');

// 
Route::get('/products', 'Frontend\ProductsController@index')->name('products');
Route::get('/products/{slug}', 'Frontend\ProductsController@show')->name('products.show');
Route::get('/search', 'Frontend\PagesController@search')->name('search');



//admin routes are here
Route::group(['prefix' => 'admin'],function(){

Route::get('/', 'Backend\PagesController@index')->name('admin.index');

//product routes are here
Route::group(['prefix' => 'products'],function(){

	
	Route::get('/', 'Backend\ProductsController@manage_products')->name('admin.products');

	Route::get('/create', 'Backend\ProductsController@product_create')->name('admin.product.create');
	Route::post('/create', 'Backend\ProductsController@product_store')->name('admin.product.store');

	Route::get('/edit/{id}', 'Backend\ProductsController@product_edit')->name('admin.product.edit');
	Route::post('/edit/{id}', 'Backend\ProductsController@product_update')->name('admin.product.update');
	Route::post('/delete/{id}', 'Backend\ProductsController@product_delete')->name('admin.product.delete');
	});
	

	//categories routes are here
	Route::group(['prefix' => 'categories'],function(){

	
	Route::get('/', 'Backend\CategoriesController@index')->name('admin.categories');

	Route::get('/create', 'Backend\CategoriesController@create')->name('admin.category.create');
	Route::post('/create', 'Backend\CategoriesController@store')->name('admin.category.store');

	Route::get('/edit/{id}', 'Backend\CategoriesController@edit')->name('admin.category.edit');
	Route::post('/edit/{id}', 'Backend\CategoriesController@update')->name('admin.category.update');
	Route::post('/delete/{id}', 'Backend\CategoriesController@delete')->name('admin.category.delete');
	});


	//brands routes are here
	Route::group(['prefix' => 'Brands'],function(){

	
	Route::get('/', 'Backend\BrandsController@index')->name('admin.brands');

	Route::get('/create', 'Backend\BrandsController@create')->name('admin.brand.create');
	Route::post('/create', 'Backend\BrandsController@store')->name('admin.brand.store');

	Route::get('/edit/{id}', 'Backend\BrandsController@edit')->name('admin.brand.edit');
	Route::post('/edit/{id}', 'Backend\BrandsController@update')->name('admin.brand.update');
	Route::post('/delete/{id}', 'Backend\BrandsController@delete')->name('admin.brand.delete');
	});

});



