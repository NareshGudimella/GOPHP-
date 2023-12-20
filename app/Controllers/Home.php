<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('myview');
    }
    public function about(){
        return view('about');
    }
    public function leftside(){
        return view('left');
    }
}
