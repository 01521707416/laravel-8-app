<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //methods
    function index()
    {
        return view('admin.category.index');
    }
}
