<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use File;
use App\Certificate;

class CertificatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $certificates = Certificate::all();
        return view('admin.certificates.index')->with('certificates', $certificates);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.certificates.create');
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
            'image' => 'required|image|mimes:jpeg,png,jpg,|max:7000'
        ], $messages);

        $image = $request->file('image');
        $image_name = time().'.'.$image->getClientOriginalExtension();
        Image::make($image)->save(public_path("images/$image_name"));

        $new = new Certificate([
            'title' => $request->title,
            'image' => $image_name
        ]);

        $new->save();

        return redirect(route('admin.certificates.create'))->with('success', 'Сертификат успешно создан');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $certificate = Certificate::findOrFail($id);
        return view('admin.certificates.edit')->with('certificate', $certificate);
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
            'image' => 'image|mimes:jpeg,png,jpg,|max:7000'
        ], $messages);

        $certificate = Certificate::findOrFail($id);

        if($request->hasFile('image')){
            $old_image = $certificate->image;
            File::delete(public_path("images/$old_image"));
            $image = $request->file('image');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            Image::make($image)->save(public_path("images/$image_name"));
            $certificate->image = $image_name;
        }

        $certificate->title = $request->title;
        $certificate->save();
        return redirect(route('admin.certificates.edit', ['certificate' => $id]))->with('success', 'Изменения сохранены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $certificate = Certificate::findOrFail($id);

        $certificate->delete();

        $image = public_path("images/$certificate->image");
        File::delete($image);

        return redirect(route('admin.certificates.index'))->with('success', 'Сертификат успешно удален');
    }
}

