<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use File;
use App\SubCategory;
use App\Category;

class SubCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = SubCategory::all();
        return view('admin.subcategories.index')->with('subcategories', $subcategories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subcategories.create');
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
            'image' => 'required|image|mimes:jpeg,png,jpg,|max:2048',
            'category' => 'required'
        ], $messages);

        $image = $request->file('image');
        $image_name = time().'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(400, 400)->save(public_path("images/$image_name"));

        $new_cat = new SubCategory([
            'name' => $request->name,
            'slug' => $request->name,
            'image' => $image_name,
            'cid' => $request->category
        ]);

        $new_cat->save();

        return redirect(route('admin.subcategories.create'))->with('success', 'Подкатегория успешно создана');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $categories = Category::all();
        return view('admin.subcategories.edit')->with(['subcategory' => $subcategory, 'categories' => $categories]);
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
            'image' => 'required|image|mimes:jpeg,png,jpg,|max:2048',
            'category' => 'required'
        ], $messages);

        $image = $request->file('image');
        $image_name = time().'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(400, 400)->save(public_path("images/$image_name"));

        $subcategory = SubCategory::find($id);
        $subcategory->name = $request->name;
        $subcategory->slug = $request->name;
        $subcategory->image = $image_name;
        $subcategory->cid = $request->category;
        $subcategory->save();
        return redirect(route('admin.subcategories.edit', ['subcategory' => $id]))->with('success', 'Изменения сохранены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcategory = SubCategory::find($id);
        $products = $subcategory->products;
        foreach($products as $product){
            $product->delete();
        }
        $subcategory->delete();

        $image = public_path("images/$subcategory->image");
        File::delete($image);

        return redirect(route('admin.categories.index'))->with('success', 'Подкатегория успешно удалена');
    }
}
