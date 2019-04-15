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

Route::get('/', "MainController@index")->name("index");

Route::get('/catalog', "CatalogController@index")->name("catalog.index");

Route::get('/catalog/{category_slug}', "CatalogController@show_category")->name("catalog.category");

Route::get('/catalog/{category_slug}/{subcategory_slug}', "CatalogController@show_subcategory")->name("catalog.subcategory");



Route::get('/brands', "BrandsController@index")->name("brands.index");

Route::get("/brands/{slug}", "BrandsController@show")->name("brands.single");
// Route::get("/brands/{slug}", function($slug){ return view('brands.single'); })->name("brands.single_item");


