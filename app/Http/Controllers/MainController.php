<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\SubCategory;
use App\Category;

use App\Product;
use App\Brand;
use App\CatalogFile;
use App\Banner;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $main_banners = Banner::whereMain(true)->get();
        $banners = Banner::whereMain('!=', true)->get();
        if($banners->count() > 1){
            $banners_chunk = $banners->chunk(ceil($banners->count() / 2));
            $banners_left = $banners_chunk[0];
            $banners_right = $banners_chunk[1];
        }else{
            $banners_chunk = [];
            $banners_left = [];
            $banners_right = [];
        }
        $products = Product::all();
        $featured = Product::where('new', true)->take(4)->get();
        $new_products = Product::where('new', true)->get();
        $brands = Brand::all();
        $first_sale = Product::where('sale', true)->first();
        if($first_sale){
            $sales = Product::whereNew(1)->where('id', '!=', $first_sale->id)->get();
        }else{
            $sales = [];
        }
        $subcategories = SubCategory::all();
        return view("index")->with(["main_banners" => $main_banners, "banners_left" => $banners_left, "banners_right" => $banners_right, "products" => $products, 'new_products' => $new_products, "brands" => $brands, "featured" => $featured, "sales" => $sales, "first_sale" => $first_sale, 'subcategories' => $subcategories]); 
    }
}
