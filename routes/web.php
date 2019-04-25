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

Route::get('/catalog/search/', "CatalogController@search")->name("catalog.search");

Route::get('/catalog/{category_slug}', "CatalogController@show_category")->name("catalog.category");

Route::get('/catalog/{category_slug}/{subcategory_slug}', "CatalogController@show_subcategory")->name("catalog.subcategory");

Route::get('/catalog/{category_slug}/{subcategory_slug}/{product_slug}', "CatalogController@show_product")->name("catalog.product");

Route::resource('/certificates', 'CertificatesController', ["only" => ['index', 'show']])->name('certificates.index', 'certificates.show');

Route::get('/about', "AboutController@index")->name('about.index');
Route::get('/about/blog', "AboutController@blog")->name('about.blog');
Route::get('/about/blog/{post_slug}', "AboutController@blog_show")->name('about.blog_single');


Route::get('/brands', "BrandsController@index")->name("brands.index");

Route::get("/brands/{slug}", "BrandsController@show")->name("brands.single");

