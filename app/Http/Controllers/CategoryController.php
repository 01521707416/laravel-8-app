<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    //methods
    function index()
    {
        $categories = Category::all();
        $trash_categories = Category::onlyTrashed()->get();
        return view('admin.category.index', [
            'categories' => $categories,
            'trash_categories' => $trash_categories,
        ]);
    }

    function insert(CategoryRequest $request)
    {
        Category::insert([
            'user_id' => Auth::id(),
            'category_name' => $request->category_name,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('success', 'message');
    }

    function soft_delete($category_id)
    {
        Category::find($category_id)->delete();
        return back()->with('delete', 'Category deleted successfully!');
    }

    function edit($category_id)
    {
        $category_info = Category::find($category_id);
        return view('admin.category.edit', compact('category_info'));
    }

    function update(Request $request)
    {
        Category::find($request->id)->update(
            [
                'user_id' => Auth::id(),
                'category_name' => $request->category_name,
                'updated_at' =>  Carbon::now(),
            ]
        );
        return redirect('/category');
    }

    function restore($category_id)
    {
        Category::onlyTrashed()->find($category_id)->restore();
        return back()->with('restore', 'Category restored successfully.');
    }


    function hard_delete($category_id)
    {
        Category::onlyTrashed()->find($category_id)->forceDelete();
        return back();
    }


    function mark_delete(Request $request)
    {
        foreach ($request->mark as $mark) {
            Category::find($mark)->delete();
        }
        return back()->with('mark_delete', 'Deleted marked items successfully!');
    }

    function mark_restore(Request $request)
    {
        foreach ($request->mark as $mark) {
            Category::onlyTrashed()->find($mark)->restore();
        }
        return back()->with('mark_restore', 'Restored marked items successfully!');
    }
}
