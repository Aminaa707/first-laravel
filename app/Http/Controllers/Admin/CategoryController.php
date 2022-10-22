<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {

        //__Query Builder__//   

        // $category = DB::table('categories')->get();

        // -------------------------------------------------------------------------------

        //__Eleoquent__//

        $category = Category::all();

        return view("admin.category.index", compact('category'));
    } //End Method

    public function create()
    {
        return view('admin.category.create');
    } // End Method


    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ]);

        //__Query Builder__//   

        // Category::insert([
        //     'category_name' => $request->category_name,
        //     'category_slug' => Str::lower($request->category_name)
        // ]);

        // ---------------------------------------------------------------------------------

        //__Eleoquent__//

        $category = new Category;
        $category->category_name = Str::headline($request->category_name);
        $category->category_slug = Str::lower($request->category_name);
        $category->save();


        $notification = array(
            'message' => 'Category added successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('category.index')->with($notification);
    } // End Method

    public function edit($id)
    {
        //__Query Builder__// 

        // $data = DB::table('categories')->where('id', $id)->first();

        //--------------------------------------------------------------------------------------------

        //__Eleoquent with first() method
        // $data = Category::where('id', $id)->first();

        //--------------------------------------------------------------------------------------------

        //__Eleoquent__//

        $data = Category::find($id);

        return view('admin.category.edit', compact('data'));
    } //End Method


    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        //__Query Builder__//

        $category->update([
            'category_name' => $request->category_name,
            'category_slug' => Str::lower($request->category_name)
        ]);

        //--------------------------------------------------------------------------------------------------

        //__Eleoquent__//

        $category->category_name = Str::ucfirst($request->category_name);
        $category->category_slug = Str::lower($request->category_name);
        $category->save();

        $notification = array(
            'message' => 'Category Updated successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('category.index')->with($notification);
    } //End Method

    public function destroy($id)
    {
        //__Query Builder__//

        // DB::table('categories')->where('id', $id)->delete();

        //__Eleoquent__//
        // $category = Category::find($id);
        // $category->delete();

        Category::destroy($id); // with destroy() method.

        $notification = array(
            'message' => 'Category Deleted successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
