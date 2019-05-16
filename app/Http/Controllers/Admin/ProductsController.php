<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use Image;
use App\Product;
use App\SubCategory;
use App\Brand;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subcategories = SubCategory::all();
        $brands = Brand::all();
        return view('admin.products.create')->with(['subcategories' => $subcategories, 'brands' => $brands]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => 'Поле :attribute не должно быть пустым.',
        ];

        $request->validate([
            'name' => 'required',
            'warranty' => 'required',
            'production' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,|max:2048',
            'additional_images' => 'array',
            'additional_images.*' => 'image|mimes:jpeg,png,jpg,|max:4096',
            'subcategory' => 'required',
            'brand' => 'required',
            'properties' => 'array',
            'values' => 'array'
        ], $messages);

        $image = $request->file('image');
        $image_name = 'product_'.time().'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(400, 400)->save(public_path("images/$image_name"));
        $add_images = [];

        if(!empty($request->additional_images)){
            foreach($request->additional_images as $add_image){
                $add_image_name = "product_".mt_rand(0, 100000).time().'.'.$add_image->getClientOriginalExtension();
                $add_images[] = $add_image_name;
                Image::make($add_image)->resize(400, 400)->save(public_path("images/$add_image_name"));
            }
        }

        $props_arr = [];

        if(!empty($request->properties) && count($request->properties) === count($request->values)){
            for($i = 0; $i < count($request->properties); $i++){
                $props_arr[$request->properties[$i]] = $request->values[$i];
            }
        }

        $new_product = new Product([
            'name' => $request->name,
            'production' => $request->production,
            'warranty' => $request->warranty,
            'slug' => $request->name,
            'description' => $request->description,
            'image' => $image_name,
            'additional_images' => implode('-', $add_images),
            "scid" => $request->subcategory,
            "bid" => $request->brand ,
            "json_properties" => empty($props_arr) ? "" : json_encode($props_arr, JSON_UNESCAPED_UNICODE)
        ]);

        $new_product->save();

        return redirect(route('admin.products.create'))->with('success', 'Продукт успешно создан');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $subcategories = SubCategory::all();
        $brands = Brand::all();
        return view('admin.products.edit')->with(['product' => $product, 'subcategories' => $subcategories, 'brands' => $brands]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'required' => 'Поле :attribute не должно быть пустым.',
        ];

         $request->validate([
            'name' => 'required',
            'warranty' => 'required',
            'production' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,|max:2048',
            'additional_images' => 'array',
            'additional_images.*' => 'image|mimes:jpeg,png,jpg,|max:4096',
            'subcategory' => 'required',
            'brand' => 'required',
            'properties' => 'array',
            'values' => 'array',
        ], $messages);

        $product = Product::findOrFail($id);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(400, 400)->save(public_path("images/$image_name"));
            $product->image = $image_name;
        }
        $add_images = [];
        
        if($request->additional_images){
            foreach($request->additional_images as $add_image){
                $add_image_name = "product_".mt_rand(0, 100000).time().'.'.$add_image->getClientOriginalExtension();
                $add_images[] = $add_image_name;
                Image::make($add_image)->resize(400, 400)->save(public_path("images/$add_image_name"));
            }
            $product->additional_images = implode("-", $add_images);
        }

        $props_arr = [];

        if(!empty($request->properties) && count($request->properties) === count($request->values)){
            for($i = 0; $i < count($request->properties); $i++){
                $props_arr[$request->properties[$i]] = $request->values[$i];
            }
        }

        $product->name = $request->name;
        $product->production = $request->production;
        $product->warranty = $request->warranty;
        $product->slug = $request->name;
        $product->description = $request->description;
        $product->scid = $request->subcategory;
        $product->bid = $request->brand;
        $product->json_properties = empty($props_arr) ? "" : json_encode($props_arr, JSON_UNESCAPED_UNICODE);
        $product->new = $request->new ?? 0;
        $product->sale = $request->sale ?? 0;
        $product->save();
        return redirect(route('admin.products.edit', ['product' => $id]))->with('success', 'Изменения сохранены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $image = $product->image;
        File::delete(public_path("images/$image"));
        $add_images = explode('-', $product->additional_images);
        foreach($add_images as $add_image){
            File::delete(public_path("images/$add_image"));
        }
        $product->delete();
        return redirect(route('admin.products.index'))->with('success', 'Продукт успешно удален');        
    }
}
