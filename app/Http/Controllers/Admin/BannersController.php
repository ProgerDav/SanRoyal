<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use File;
use App\SubCategory;
use App\Brand;
use App\Banner;

class BannersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::all();
        return view('admin.banners.index')->with('banners', $banners);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subcategories = Subcategory::all();
        $brands = Brand::all();
        return view('admin.banners.create')->with(['subcategories' => $subcategories, 'brands' => $brands]);
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
            'subcategory' => 'required',
            'brand' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,|max:2048'
        ], $messages);

        $image = $request->file('image');
        $image_name = 'banner_'.time().'.'.$image->getClientOriginalExtension();
        Image::make($image)->save(public_path("images/$image_name"));

        $banner = new Banner([
            'scid' => $request->subcategory,
            'bid' => $request->brand,
            'main' => $request->main,
            'image' => $image_name,
        ]);

        $banner->save();

        return redirect(route('admin.banners.create'))->with('success', 'Баннер успешно создан');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        $subcategories = SubCategory::all();
        $brands = Brand::all();
        return view('admin.banners.edit')->with(['banner' => $banner, 'brands' => $brands, 'subcategories' => $subcategories]);
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
            'subcategory' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,|max:2048',
            'brand' => 'required'
        ], $messages);

        $banner = Banner::findOrFail($id);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $image_name = 'banner_'.time().'.'.$image->getClientOriginalExtension();
            Image::make($image)->save(public_path("images/$image_name"));

            File::delete(public_path("images/$banner->image"));
            $banner->image = $image_name;
        }

        $banner->scid = $request->subcategory;
        $banner->bid = $request->brand;
        $banner->main = $request->main;
        $banner->save();
        return redirect(route('admin.banners.edit', ['banner' => $banner->id]))->with('success', 'Изменения сохранены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::findOrFail($id); 
        $banner->delete();

        $image = public_path("images/$banner->image");
        File::delete($image);

        return redirect(route('admin.banners.index'))->with('success', 'Баннер успешно удален');
    }
}
