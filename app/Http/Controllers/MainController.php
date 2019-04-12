<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use App\SubCategory;
use App\Category;


class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Category::all();
        return view("layouts.main")->with("data", $data);   
    }
}
