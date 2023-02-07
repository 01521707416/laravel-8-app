<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        $products = Product::latest()->take(6)->get();
        $new_arrival = Product::latest()->take(4)->get();
        $categories = Category::all();
        return view('frontend.index', [
            'products' => $products,
            'new_arrival' => $new_arrival,
            'categories' => $categories,
        ]);
    }

    function product_details()
    {
        echo 'I love Sabrina';
    }
}
