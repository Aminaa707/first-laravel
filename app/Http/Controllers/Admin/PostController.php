<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Image;

class PostController extends Controller
{

    public function _construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // This is query builder join..I don't need it. Because I did join in post model.

        // $post = DB::table('posts')
        //     ->leftJoin('categories', "posts.category_id", "categories.id")
        //     ->leftJoin('subcategorieds', "posts.subcategory_id", "subcategorieds.id")
        //     ->leftJoin('users', "posts.user_id", "users.id")
        //     ->select('posts.*', 'categories.category_name', 'subcategorieds.subcategory_name', 'users.name')
        //     ->get();




        $post = Post::all();
        return view('admin.post.index', compact('post'));
    } // End Mathod

    public function create()
    {
        $categories = Category::all();
        return view('admin.post.create', compact('categories'));
    } // End Mathod

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subcategory_id' => 'required',
            'title' => 'required',
            'tags' => 'required',
            'description' => 'required',
        ]);

        $categoryid = DB::table('subcategorieds')->where('id', $request->subcategory_id)->first()->category_id; // collecting categoryId from Subcatefori table.
        $slug =  Str::slug($request->title, '-');

        $data = new Post;
        $data->category_id = $categoryid;
        $data->subcategory_id = $request->subcategory_id;
        $data->user_id = Auth::id();
        $data->title = $request->title;
        $data->slug = $slug;
        $data->post_date = $request->post_date;
        // $data->image = $request->image;
        $data->description = $request->description;
        $data->tags = $request->tags;
        $data->status = $request->status;
        $photo = $request->image;

        if ($photo) {
            $photoName = $slug . '.' . $photo->getClientOriginalExtension(); // image name like (slug.png)

            // if file exists img will save in this file if file not exist it will first create file then save the img .
            $relPath = 'media/';
            if (!file_exists(($relPath))) {
                mkdir(($relPath), 777, true);
            }
            Image::make($photo)->resize(600, 360)->save('media/' . $photoName); // saving resized img in media folder.
            $data->image = 'public/media/' . $photoName; // saving img in database
            $data->save();

            $notification = array(
                'message' => 'Post created successfully!',
                'alert-type' => 'success'
            );
            return redirect()->route('post.index')->with($notification);
        }
        $data->save();

        $notification = array(
            'message' => 'Post created successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('post.index')->with($notification);
    } // End Mathod

}
