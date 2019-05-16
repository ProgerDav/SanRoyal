<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

use App\Category;
use App\Product;
use App\Brand;
use App\CatalogFile;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(Request $request){
        
        $this->middleware(function ($request, $next) { //Closure Middleware Որ session-ը ճանաչի
            $categories = Category::all();
            $brands = Brand::all();
            $catalogs = CatalogFile::all();
            $viewed = Product::find($request->session()->get('viewed'));
            view()->share(['viewed' => $viewed, 'categories' => $categories, "brands" => $brands, "catalogs" => $catalogs]);
            return $next($request);
        });

        // view()->share(['categories' => $categories, "brands" => $brands, "catalogs" => $catalogs, 'viewed' => $viewed]);
    }
}
