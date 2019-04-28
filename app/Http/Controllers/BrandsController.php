<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Brand;
use App\Category;
use App\SubCategory;

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
        $parts = explode('-', $slug);
        $id = array_shift($parts);
        $slug = implode('-', $parts);
        $brand = Brand::findOrFail($id);

        if(Str::slug($brand->slug) !== $slug) return redirect()->route('brands.single', ['slug' => Str::slug($brand->id.' '.$brand->slug)]);

        $arr = $brand->products->groupBy('scid')->map(function($item){ return $item->first()->scid; })->toArray();
        $result = Category::find(SubCategory::find($arr)->map(function($subcat){ return $subcat->cid; }));

        return view("brands.single")->with(['brand' => $brand, "available_categories" => $result]);
    }
}
