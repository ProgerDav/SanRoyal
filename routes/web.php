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

Route::get('/catalog/download', "CatalogController@downloadIndex")->name("catalog.download.index");

Route::get('/catalog/search/', "CatalogController@search")->name("catalog.search");

Route::get('/catalog/{category_slug}', "CatalogController@show_category")->name("catalog.category");

Route::get('/catalog/{category_slug}/{subcategory_slug}', "CatalogController@show_subcategory")->name("catalog.subcategory");

Route::get('/catalog/{category_slug}/{subcategory_slug}/{product_slug}', "CatalogController@show_product")->name("catalog.product");

Route::resource('/certificates', 'CertificatesController', ["only" => ['index', 'show']])->name('certificates.index', 'certificates.show');

Route::get('/about', "AboutController@index")->name('about.index');
Route::get('/about/vacancies', "AboutController@vacancies")->name('about.vacancies');
Route::post('/about/vacancies/request', "FormsController@storeVacancy")->name('about.vacancies.request');
Route::get('/about/blog', "AboutController@blog")->name('about.blog');
Route::get('/about/blog/{post_slug}', "AboutController@blog_show")->name('about.blog_single');


Route::get('/brands', "BrandsController@index")->name("brands.index");

Route::get("/brands/{slug}", "BrandsController@show")->name("brands.single");

Route::get("/contact", "FormsController@showContactForm")->name('contact');
Route::post("/contact", "FormsController@storeMessage");

Route::get('/price-list', "FormsController@showPriceListForm")->name('price-list');
Route::post('/price-list-store', "FormsController@storePriceListRequest")->name('price-list-store');

Route::get('/home', function(){ return redirect()->route('admin.index'); });

Auth::routes(['register' => false, 'reset' => false]);

Route::middleware('auth')->namespace('Admin')->prefix('admin-panel')->name('admin.')->group(function(){
  Route::get('/', 'AdminController@index')->name('index');
  Route::resource('/banners', 'BannersController', ["only" => ['index', 'create', 'update', 'edit', 'store', 'destroy']]);
  Route::resource('/categories', 'CategoriesController', ["only" => ['index', 'create', 'update', 'edit', 'store', 'destroy']]);
  Route::resource('/subcategories', 'SubCategoriesController', ["only" => ['index', 'create', 'update', 'edit', 'store', 'destroy']]);
  Route::resource('/products', 'ProductsController', ["only" => ['index', 'create', 'update', 'edit', 'store', 'destroy']]);
  Route::resource('/certificates', 'CertificatesController', ["only" => ['index', 'create', 'update', 'edit', 'store', 'destroy']]);
  Route::resource('/brands', 'BrandsController', ["only" => ['index', 'create', 'update', 'edit', 'store', 'destroy']]);
  Route::resource('/posts', 'PostsController', ["only" => ['index', 'create', 'update', 'edit', 'store', 'destroy']]);
  Route::resource('/vacancies', 'VacanciesController', ["only" => ['index', 'create', 'update', 'edit', 'store', 'destroy']]);
  Route::resource('/catalogs', 'CatalogsController', ["only" => ['index', 'create', 'update', 'edit', 'store', 'destroy']]);
  Route::resource('/requests', 'RequestsController', ["only" => ['index', 'show', 'destroy']]);
  Route::resource('/rezumes', 'RezumesController', ["only" => ['index', 'show', 'destroy']]);
  Route::resource('/messages', 'MessagesController', ["only" => ['index', 'show', 'destroy']]);
});

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/cookie/set/{id}','CookieController@setCookie');   
Route::get('/cookie/get','CookieController@getCookie');