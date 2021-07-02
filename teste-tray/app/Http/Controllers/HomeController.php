<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('templete.views.index');
    }
    
    public function enter($message = ""){
        return view('templete.views.login', compact('message'));
    }
    
}
