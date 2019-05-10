<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Request as PriceListRequest;

class RequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(){
        $requests = PriceListRequest::all();
        return view('admin.requests.index')->with("requests", $requests);
    }

    /**
     * Show the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $request = PriceListRequest::findOrFail($id);
        return view('admin.requests.show')->with('request', $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $request = PriceListRequest::findOrFail($id);

        $request->delete();

        return redirect(route('admin.requests.index'))->with('success', 'Запрос успешно удален');
    }
}
