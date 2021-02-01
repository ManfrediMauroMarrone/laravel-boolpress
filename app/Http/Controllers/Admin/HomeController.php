<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
  public function index()
  {
      return view('admin.home');
  }

  public function account(){
    return view('admin.account');
  }

  public function generateToken(){
    // genero api token
    $api_token = Str::random(80);
    // lo assegno allo user corrente
    $user = Auth::user();
    $user->api_token = $api_token;
    $user->save();
    return redirect()->route('admin.account');
  }
}
