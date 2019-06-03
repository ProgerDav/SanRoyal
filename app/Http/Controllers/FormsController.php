<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Message;
use App\Request as PriceListRequest;
use App\Category;
use App\Rezume;
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
            'required' => 'Это поле обязательно-:attribute',
        ];

       $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
       ], $messages);
        
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()], 200, [], JSON_UNESCAPED_UNICODE);
        }

        $message = new Message($request->all());
        $message->save();

        return response()->json(['success'=>'Сообщение отправлено'], 200, [], JSON_UNESCAPED_UNICODE);
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
        // Mail::to('davit.gyulnazaryan@tumo.org')->send(new AdminMailer($request->contact_name));

        $messages = [
            'required' => 'Это поле обязательно-:attribute',
        ];

       $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'organization' => 'required',
            'categories' => 'required|array'
       ], $messages);
        
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()], 200, [], JSON_UNESCAPED_UNICODE);
        }

        $categories = implode('-', $request->categories);

        $list_request = new PriceListRequest(array_merge($request->except('categories'), ['categories' => $categories]));
        $list_request->save();

        return response()->json(['success'=>'Ваш зарос отправлен'], 200, [], JSON_UNESCAPED_UNICODE);
    }    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeVacancy(Request $request){
        $messages = [
            'required' => 'Это поле обязательно-:attribute',
        ];

       $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'profession' => 'required',
            'file' => 'required',
            'text' => 'required',
       ], $messages);
        
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()], 200, [], JSON_UNESCAPED_UNICODE);
        }

        $filename = "rezume_".time().'.'.$request->file('file')->getClientOriginalExtension();
        $request->file('file')->move(public_path("/documents/rezumes/"), $filename);

        $new_rezume = new Rezume([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'profession' => $request->profession,
            'text' => $request->text,
            'file' => $filename
        ]);
        $new_rezume->save();

        return response()->json(['success'=>'Ваш зарос отправлен'], 200, [], JSON_UNESCAPED_UNICODE);
    }    
}
