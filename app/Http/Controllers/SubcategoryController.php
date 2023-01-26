<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    //methods
    function add_subcategory()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $trash_subcategories = Subcategory::onlyTrashed()->get();
        return view('admin.subcategory.index', [
            'categories' => $categories,
            'subcategories' => $subcategories,
            'trash_subcategories' => $trash_subcategories,
        ]);
    }

    function insert(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'subcategory_name' => 'required',
        ]);

        if (Subcategory::where('category_id', $request->category_id)->where('subcategory_name', $request->subcategory_name)->exists()) {
            return back()->with('exist', 'Sub Category already exists!');
        } else {
            Subcategory::insert([
                'category_id' => $request->category_id,
                'subcategory_name' => $request->subcategory_name,
                'created_at' => Carbon::now(),
            ]);
            return back()->with('success', 'message');
        }
    }

    function edit($subcategory_id)
    {
        $categories = Category::all();
        $subcategories_info = Subcategory::find($subcategory_id);

        return view('admin.subcategory.edit', [
            'categories' => $categories,
            'subcategories_info' => $subcategories_info,

        ]);
    }

    function update(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'subcategory_name' => 'required',
        ]);

        if (Subcategory::where('category_id', $request->category_id)->where('subcategory_name', $request->subcategory_name)->exists()) {
            return back()->with('exist', 'Sub Category already exists!');
        } else {
            Subcategory::find($request->subcategory_id)->update([
                'category_id' => $request->category_id,
                'subcategory_name' => $request->subcategory_name,
                'updated_at' => Carbon::now(),
            ]);
            return redirect()->route('add.subcategory');
        }
    }

    function soft_delete($subcategory_id)
    {
        Subcategory::find($subcategory_id)->delete();
        return back()->with('delete', 'Subategory moved to trash!');
    }

    function restore($subcategory_id)
    {
        Subcategory::onlyTrashed()->find($subcategory_id)->restore();
        return back()->with('restore', 'Subcategory restored successfully');
    }

    function hard_delete($subcategory_id)
    {
        Subcategory::onlyTrashed()->find($subcategory_id)->forceDelete();
        return back()->with('hard_delete', 'Subategory deleted forever!');
    }

    function mark_delete(Request $request)
    {
        foreach ($request->mark as $mark) {
            Subcategory::find($mark)->delete();
        }
        return back()->with('mark_delete', 'Deleted marked items successfully!');
    }
}
