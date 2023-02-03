<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Inventory;
use App\Models\Product;
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
        $request->validate([
            'color_name' => 'required',
            'color_code' => 'required',
        ]);

        Color::insert([
            'color_name' => $request->color_name,
            'color_code' => $request->color_code,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('color_success', 'Color added successfully!');
    }

    function edit_color($color_id)
    {
        $color_info = Color::find($color_id);
        return view('admin.inventory.edit_color', [
            'color_info' => $color_info,
        ]);
    }

    function update_color(Request $request)
    {
        Color::find($request->id)->update([
            'color_name' => $request->color_name,
            'color_code' => $request->color_code,
            'updated_at' => Carbon::now(),
        ]);
        return redirect('add/color/size');
    }

    function insert_size(Request $request)
    {
        $request->validate([
            'size_name' => 'required',
        ]);

        Size::insert([
            'size_name' => $request->size_name,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('size_success', 'Size added successfully!');
    }

    function inventory($product_id)
    {
        $product_info = Product::find($product_id);
        $colors = Color::all();
        $sizes = Size::all();
        $inventories = Inventory::where('product_id', $product_id)->get();
        return view('admin.inventory.inventory', [
            'product_info' => $product_info,
            'colors' => $colors,
            'sizes' => $sizes,
            'inventories' => $inventories,
        ]);
    }

    function inventory_insert(Request $request)
    {
        $request->validate([
            'color_id' => 'required',
            'size_id' => 'required',
            'quantity' => 'required',
        ]);

        if (Inventory::where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->exists()) {
            Inventory::where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->increment('quantity', $request->quantity);
        } else {
            Inventory::insert([
                'product_id' => $request->product_id,
                'color_id' => $request->color_id,
                'size_id' => $request->size_id,
                'quantity' => $request->quantity,
                'created_at' => Carbon::now(),
            ]);
            return back();
        }
        return back();
    }
}
