<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\SubCategory;
use App\Category;

use App\Product;
use App\Brand;


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
        $featured = Product::all()->take(4);
        $brands = Brand::all();
        $sales = Product::all()->take(9);
        return view("index")->with(["products" => $products, "brands" => $brands, "featured" => $featured, "sales" => $sales]); 
    }
}
