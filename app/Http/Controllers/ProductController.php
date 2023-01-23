<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\Thumbnail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

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

    function view()
    {
        $all_products = Product::all();
        return view('admin.product.product_list', [
            'all_products' => $all_products,
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

    function insert(Request $request)
    {
        $product_id = Product::insertGetId([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'discount' => $request->discount,
            'after_discount' => $request->product_price - ($request->product_price * $request->discount) / 100,
            'short_desp' => $request->short_desp,
            'long_desp' => $request->long_desp,

        ]);

        $uploaded_file = $request->preview;
        $extension = $uploaded_file->getClientOriginalExtension();
        $file_name = $product_id . '.' . $extension;
        Image::make($uploaded_file)->resize(680, 680)->save(public_path('/uploads/products/preview/' . $file_name));

        Product::find($product_id)->update([
            'preview' => $file_name,
        ]);

        $loop = 1;
        $thumbnail_images = $request->thumbnail;
        foreach ($thumbnail_images as $thumb) {
            $thumbnail_extension = $thumb->getClientOriginalExtension();
            $thumb_file_name = $product_id . '-' . $loop . '.' . $thumbnail_extension;

            Image::make($thumb)->resize(680, 680)->save(public_path('/uploads/products/thumbnail/' . $thumb_file_name));

            Thumbnail::insert([
                'product_id' => $product_id,
                'thumbnail' => $thumb_file_name,
                'created_at' => Carbon::now(),
            ]);

            $loop++;
        }

        return back()->with('success', 'Product Added Successfully!');
    }
}
