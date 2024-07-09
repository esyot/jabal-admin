<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('/dashboard');
    }

    public function clients(){
        return view('/clients');
    }
}
