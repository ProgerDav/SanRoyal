<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use File;
use App\Category;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
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
            'image' => 'required|image|mimes:jpeg,png,jpg,|max:2048'
        ], $messages);

        $image = $request->file('image');
        $image_name = time().'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(400, 400)->save(public_path("images/$image_name"));

        $new_cat = new Category([
            'name' => $request->name,
            'slug' => $request->name,
            'image' => $image_name
        ]);

        $new_cat->save();

        return redirect(route('admin.categories.create'))->with('success', 'Категория успешно создана');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit')->with('category', $category);
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
            'image' => 'required|image|mimes:jpeg,png,jpg,|max:2048'
        ], $messages);

        $image = $request->file('image');
        $image_name = time().'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(400, 400)->save(public_path("images/$image_name"));

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->slug = $request->name;
        $category->image = $image_name;
        $category->save();
        return redirect(route('admin.categories.edit', ['category' => $id]))->with('success', 'Изменения сохранены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $subcategories = $category->subcategories;
        foreach($subcategories as $subcategory){
            $products = $subcategory->products;
            foreach($products as $product){
                $product->delete();
            }
            $subcategory->delete();
        }

        $category->delete();

        $image = public_path("images/$category->image");
        File::delete($image);

        return redirect(route('admin.categories.index'))->with('success', 'Категория успешно удалена');
    }
}
