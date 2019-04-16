<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\SubCategory;
use App\Product;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view("catalog.index")->with("categories", $categories);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $category_slug
     * @return \Illuminate\Http\Response
     */
    public function show_category($category_slug)
    {
        $category_slug = str_replace("-", " ", $category_slug);
        $category = Category::where('slug', $category_slug)->firstOrFail();
        $subcategories = $category->subcategories;
        return view('catalog.category')->with(["subcategories" => $subcategories, "category" => $category]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $category_slug
     * @param  string  $subcategory_slug      
     * @return \Illuminate\Http\Response
     */
    public function show_subcategory($category_slug, $subcategory_slug)
    {
        $category_slug = str_replace("-", " ", $category_slug);
        $subcategory_slug = str_replace("-", " ", $subcategory_slug);
        $category = Category::where('slug', $category_slug)->firstOrFail();
        $subcategory = SubCategory::where('slug', $subcategory_slug)->firstOrFail();
        $products = $subcategory->products()->paginate(10);
        return view('catalog.subcategory')->with(["subcategory" => $subcategory, "category" => $category, "products" => $products]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $category_slug
     * @param  string  $subcategory_slug 
     * @param  string  $product_slug                 
     * @return \Illuminate\Http\Response
     */

    // public function show_product($category_slug, $subcategory_slug, $product_slug)
    // {
    //     $category_slug = str_replace("-", " ", $category_slug);
    //     $subcategory_slug = str_replace("-", " ", $subcategory_slug);
    //     $category = Category::where('slug', $category_slug)->firstOrFail();
    //     $subcategory = SubCategory::where('slug', $subcategory_slug)->firstOrFail();

    //     return view('catalog.subcategory')->with(["subcategory" => $subcategory, "category" => $category, "products" => $products]);
    // }
}
