<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Category;
use App\Brand;
use App\CatalogFile;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(){
        $categories = Category::all();
        $brands = Brand::all();
        $catalogs = CatalogFile::all();

        view()->share(['categories' => $categories, "brands" => $brands, "catalogs" => $catalogs]);
    }
}
