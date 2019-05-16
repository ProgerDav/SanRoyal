<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\SubCategory;
use App\Category;

use App\Product;
use App\Brand;
use App\CatalogFile;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        return view("index")->with(["products" => $products, 'new_products' => $new_products, "brands" => $brands, "featured" => $featured, "sales" => $sales, "first_sale" => $first_sale, 'subcategories' => $subcategories]); 
    }
}
