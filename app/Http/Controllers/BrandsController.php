<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();
        return view('brands.index')->with('brands', $brands);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show(string $slug)
    {
        $slug = str_replace('-', " ", $slug);
        $brand = Brand::firstOrFail()->where('slug', $slug)->get();

        $available_categories = $available_sub_categories = [];

        if($brand->count() != 0){
            $brand->first()->products;
            foreach($brand->first()->products as $product){
                if(!in_array($product->first()->sub_categories->name, $available_sub_categories)){
                    array_push($available_sub_categories, $product->sub_categories->first()->name);
                }
            }
        }

        return view("brands.single")->with(['brand' => $brand, 'arr' => $available_sub_categories]);
    }
}
