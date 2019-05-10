<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Message;
use App\Request as PriceListRequest;
use App\Category;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminMailer;

class FormsController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showContactForm(){
        return view('contact');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeMessage(Request $request){
        $messages = [
            'required' => '',
        ];
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required'
        ]);

        $message = new Message($request->all());
        $message->save();

        return redirect(route('contact'))->with('success', 'Сообщение отправлено');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showPriceListForm(){
        $categories = Category::all();
        return view('price_list')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storePriceListRequest(Request $request){
        $messages = [
            'required' => 'Это поле обязательно',
        ];
        $request->validate([
            'contact_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'organization' => 'required'
        ]);

        $categories = implode('-', $request->categories);

        $list_request = new PriceListRequest(array_merge($request->except('categories'), ['categories' => $categories]));
        $list_request->save();

        // Mail::to('davit.gyulnazaryan@tumo.org')->send(new AdminMailer($request->contact_name));

        return back()->with('success', 'Зарос отправлен');
    }    
}
