<?php

namespace App\Http\Controllers;

use App\Models\Product;
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

    function index()
    {
        $products = Product::take(6)->get();
        return view('frontend.index', [
            'products' => $products,
        ]);
    }
}
