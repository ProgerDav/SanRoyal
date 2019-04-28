<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use File;
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
        return view('admin.brands.index')->with('brands', $brands);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brands.create');
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
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,|max:2048'
        ], $messages);

        $image = $request->file('image');
        $image_name = 'brand_'.time().'.'.$image->getClientOriginalExtension();
        Image::make($image)->save(public_path("images/$image_name"));

        $new_brand = new Brand([
            'name' => $request->name,
            'slug' => $request->name,
            'description' => $request->description,
            'image' => $image_name
        ]);

        $new_brand->save();

        return redirect(route('admin.brands.create'))->with('success', 'Бренд успешно создан');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brands.edit')->with('brand', $brand);
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
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,|max:7000'
        ], $messages);

        $brand = Brand::findOrFail($id);

        if($request->hasFile('image')){
            $old_image = $brand->image;
            File::delete(public_path("images/$old_image"));
            $image = $request->file('image');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            Image::make($image)->save(public_path("images/$image_name"));
            $brand->image = $image_name;
        }

        $brand->name = $request->name;
        $brand->description = $request->description;
        $brand->save();
        return redirect(route('admin.brands.edit', ['brand' => $id]))->with('success', 'Изменения сохранены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);


        $image = public_path("images/$brand->image");
        File::delete($image);

        $brand->delete();

        return redirect(route('admin.brands.index'))->with('success', 'Бренд успешно удален');
    }
}

