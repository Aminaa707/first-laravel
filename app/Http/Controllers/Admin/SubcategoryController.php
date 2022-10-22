<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategoried;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class SubcategoryController extends Controller
{

    public function index()
    {
        $subCategory = Subcategoried::all();
        return view('admin.subCategory.index', compact('subCategory'));

        // return response()->json($subCategory);
    } // End Matho


    public function create()
    {
        $categories = Category::all();

        return view('admin.subCategory.create', compact('categories'));
    } // End Mathod

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required',
            'subcategory_name' => 'required|unique:subcategorieds|max:255',
        ]);
        $subCategory = new Subcategoried;
        $subCategory->category_id = $request->category_id;
        $subCategory->subcategory_name = Str::headline($request->subcategory_name);
        $subCategory->subcategory_slug = Str::lower($request->subcategory_name);
        $subCategory->save();

        $notification = array(
            'message' => 'SubCategory added successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('subcategory.index')->with($notification);
    } // End Mathod


    function edit($id)
    {
        $categories = Category::all();
        $data = Subcategoried::find($id);

        return view('admin.subCategory.edit', compact('categories', 'data'));
    } // End Mathod


    public function update(Request $request, $id)
    {
        $subCategory = Subcategoried::find($id);
        $subCategory->category_id = $request->category_id;
        $subCategory->subcategory_name = Str::headline($request->subcategory_name);
        $subCategory->subcategory_slug = Str::lower($request->subcategory_name);
        $subCategory->save();

        $notification = array(
            'message' => 'SubCategory updated successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('subcategory.index')->with($notification);
    } // End Mathod


    public function destroy($id)
    {
        Subcategoried::destroy($id);
        $notification = array(
            'message' => 'SubCategory Deleted successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Mathod
}
