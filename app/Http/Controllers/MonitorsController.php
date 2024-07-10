<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Monitor;

class MonitorsController extends Controller
{
    public function index(){

        $email = auth()->user()->email;
        
        $actions = Monitor::where('user_email', $email)->orderby('created_at', 'DESC')->get();

        return view('actions', compact('actions'));
    }
}
