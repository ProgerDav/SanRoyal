<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;

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
        $parts = explode('-', $category_slug);
        $id = array_shift($parts);
        $category_slug = implode('-', $parts);
        $category = Category::findOrFail($id);

        if(Str::slug($category->slug) !== $category_slug) return redirect()->route('catalog.category', ['category_slug' => Str::slug($id.'-'.Str::slug($category->slug))]);

        return view('catalog.category')->with(["subcategories" => $category->subcategories, "category" => $category]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $query
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
       $products = Product::where('name', 'like', "%".request()->q."%")
                    ->orWhere('description', 'like', "%".request()->q."%")
                    ->orWhereHas('sub_categories', function($q){
                        $q->where('name', 'like', "%".request()->q."%");
                    })->paginate(10);

        $arr = explode(' ', request()->q);
        $initialCount = $products->count();
        
        if($initialCount == 0) 
            $products = Product::Where(function($q) use($arr){ 
                foreach($arr as $item){
                    $q->orWhere('name', 'like', '%'.$item.'%'); 
                }
            })->OrWhere(function($q) use($arr){ 
                foreach($arr as $item){
                    $q->orWhere('description', 'like', '%'.$item.'%'); 
                }
            })->orWhereHas('sub_categories', function($q) use($arr){
                $q->Where(function ($sub_query) use($arr){
                    foreach($arr as $item){
                        $sub_query->orWhere('name', 'like', '%'.$item.'%'); 
                    }   
                });
            })->paginate(10);

            array_walk($arr, function(&$x) {$x = "<span>$x</span>";});
        return view('catalog.search')->with(['products' => $products, 'keywords' => $initialCount == 0 ? $arr : []]);
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
        $parts = explode('-', $subcategory_slug);
        $id = array_shift($parts); //SubCategory id
        $subcategory_slug = implode('-', $parts);
        $subcategory = SubCategory::findOrFail($id);
        $category = $subcategory->categories;
        if(request()->brands){
            $brands = request()->brands;
            array_walk($brands, function(&$item){
                $item = str_replace('-', ' ', $item);
            });
            $products = $subcategory->products()->with('brands')->whereHas('brands', function($query) use($brands){ $query->whereIn('slug', $brands); })->paginate(10);
        }else{
            $products = $subcategory->products()->paginate(10);
        }
        $available_brands = [];
        foreach($subcategory->products as $product){
            if(!in_array($product->brands, $available_brands)) $available_brands[] = $product->brands;
        }

        if(Str::slug($category->slug) !== $category_slug OR Str::slug($subcategory->slug) !== $subcategory_slug) return redirect()->route('catalog.subcategory', ['category_slug' => Str::slug($category->slug), 'subcategory_slug' => Str::slug($id.'-'.$subcategory->slug)]);

        return view('catalog.subcategory')->with(["subcategory" => $subcategory, "category" => $category, "products" => $products, "available_brands" => $available_brands]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $category_slug
     * @param  string  $subcategory_slug 
     * @param  string  $product_slug                 
     * @return \Illuminate\Http\Response
     */

    public function show_product($category_slug, $subcategory_slug, $product_slug)
    {
        $parts = explode('-', $product_slug);
        $id = array_shift($parts);
        $product_slug = implode('-', $parts);
        $product = Product::findOrFail($id);
        $subcategory = $product->sub_categories;
        $category = $subcategory->categories;
        $arr = [$product->slug, $product_slug];

        if(Str::slug($category->slug) !== $category_slug OR Str::slug($subcategory->slug) !== $subcategory_slug OR Str::slug($product->slug) !== $product_slug) return redirect()->route('catalog.product', ['category_slug' => Str::slug($category->slug), 'subcategory_slug' => Str::slug($subcategory->slug), 'product_slug' => Str::slug($id.'-'.$product->slug)]);

        return view('catalog.product')->with(["subcategory" => $subcategory, "category" => $category, "product" => $product, 'arr' => $arr]);
    }
}
