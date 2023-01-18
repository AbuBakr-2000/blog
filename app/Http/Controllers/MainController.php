<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){

//        dd(session()->all());
        return view('main');
    }

    public function about(){

        return view('about');
    }
    public function service(){

        return view('service');
    }
    public function projects(){

        return view('projects');
    }
    public function contact(){
        return view('contact');
    }
}
