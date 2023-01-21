<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //methods
    function index()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('admin.product.index', [
            'categories' => $categories,
            'subcategories' => $subcategories,
        ]);
    }

    function getSubcategory(Request $request)
    {
        $subcategories = Subcategory::where('category_id', $request->category_id)->get();
        $str = '<option value="">-- Select Category --</option>';
        foreach ($subcategories as $subcategory) {
            $str .= '<option value="' . $subcategory->id . '">' . $subcategory->subcategory_name . '</option>';
        }
        echo $str;
    }
}
