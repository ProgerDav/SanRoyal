<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
        return view('certificates.index')->with('certificates', $certificates);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $arr = explode('-', $slug);
        $id = array_shift($arr);
        $certificate = Certificate::findOrFail($id);
        $slug = implode('-', $arr);

        if(Str::slug($certificate->title) != $slug) return redirect()->route('certificates.show', ['slug' => Str::slug($certificate->id.' '.$certificate->title)]);

        return view('certificates.show')->with('certificate', $certificate);
    }

}
