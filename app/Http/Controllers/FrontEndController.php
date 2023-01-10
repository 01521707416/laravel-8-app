<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    //methods
    function welcome()
    {
        return view('frontend.welcome');
    }

    function about()
    {
        return view('frontend.about');
    }
}
