<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Rezume;

class RezumesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(){
        $rezumes = Rezume::all();
        return view('admin.rezumes.index')->with("rezumes", $rezumes);
    }

    /**
     * Show the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rezume = Rezume::findOrFail($id);
        return view('admin.rezumes.show')->with('rezume', $rezume);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rezume = Rezume::findOrFail($id);

        $rezume->delete();

        return redirect(route('admin.rezumes.index'))->with('success', 'Запрос успешно удален');
    }
}

