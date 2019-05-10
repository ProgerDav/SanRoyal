<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CookieController extends Controller {

   public static function setCookie($id){
      $response = new Response('Hello World');
      $response->withCookie(cookie('visited', $id));
      return $id;
   }
   public function getCookie(Request $request){
      $value = $request->cookie('visited');
      echo $value;
   }
}