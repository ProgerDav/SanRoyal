<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use File;
use App\CatalogFile;
class CatalogsController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catalogs = CatalogFile::all();
        return view('admin.catalogs.index')->with('catalogs', $catalogs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.catalogs.create');
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
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,|max:2048',
            'file' => 'required|mimes:pdf|max:50000'
        ], $messages);

        $image = $request->file('image');
        $image_name = time().'.'.$image->getClientOriginalExtension();
        Image::make($image)->save(public_path("images/$image_name"));

        $file = $request->file('file');
        $file_name = "catalog_".time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path("/documents/catalogs"), $file_name);

        $new_cat = new CatalogFile([
            'title' => $request->title,
            'image' => $image_name,
            'file' => $file_name
        ]);

        $new_cat->save();

        return redirect(route('admin.catalogs.create'))->with('success', 'Каталог успешно создан');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $catalog = CatalogFile::findOrFail($id);
        return view('admin.catalogs.edit')->with('catalog', $catalog);
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
            'title' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,|max:2048',
            'file' => 'mimes:pdf|max:50000'
        ], $messages);


        $catalog = CatalogFile::findOrFail($id);
        $catalog->title = $request->title;

        if($request->hasFile('image')){
            $prev_image = $catalog->image;
            $image = $request->file('image');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(400, 400)->save(public_path("images/$image_name"));
            $catalog->image = $image_name;
            File::delete(public_path("/images/$catalog->image"));
        }

        if($request->hasFile('file')){
            $prev_file = $catalog->file;
            $file = $request->file('file');
            $file_name = "catalog_".time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path("/documents/catalogs"), $file_name);
            File::delete(public_path("/documents/catalogs/$prev_file"));
        }

        $catalog->save();

        return redirect(route('admin.catalogs.edit', ['catalog' => $id]))->with('success', 'Изменения сохранены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $catalog = CatalogFile::findOrFail($id);

        $image = public_path("/images/$catalog->image");
        File::delete($image);

        $file = public_path("/documents/catalogs/$catalog->file");
        File::delete($file);

        $catalog->delete();

        return redirect(route('admin.catalogs.index'))->with('success', 'Каталог успешно удален');
    }
}
