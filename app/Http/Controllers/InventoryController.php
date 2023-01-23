<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Size;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    //methods
    function color()
    {
        $sizes = Size::all();
        $colors = Color::all();
        return view('admin.inventory.color_size', [
            'colors' => $colors,
            'sizes' => $sizes,
        ]);
    }

    function insert_color(Request $request)
    {
        Color::insert([
            'color_name' => $request->color_name,
            'color_code' => $request->color_code,
            'created_at' => Carbon::now(),
        ]);
        return back();
    }

    function insert_size(Request $request)
    {
        Size::insert([
            'size_name' => $request->size_name,
            'created_at' => Carbon::now(),
        ]);
        return back();
    }
}
