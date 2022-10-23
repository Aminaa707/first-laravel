<?php

namespace App\Http\Controllers\Admin;

use App\Events\PostProcessed;
use App\Http\Controllers\Controller;
use App\Jobs\PostPodcast;
use App\Models\{Category, Post};
// use Faker\Core\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use File, Image;



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
            'category' => 'required', // this is subcategory_id
            'title' => 'required',
            'tags' => 'required',
            'description' => 'required',
        ]);

        $categoryid = DB::table('subcategorieds')->where('id', $request->category)->first()->category_id; // collecting categoryId from Subcatefori table.
        $slug =  Str::slug($request->title, '-');

        $data = new Post;
        $data->category_id = $categoryid;
        $data->subcategory_id = $request->category;
        $data->user_id = Auth::id();
        $data->title = $request->title;
        $data->slug = $slug;
        $data->post_date = $request->post_date;
        // $data->image = $request->image;
        $data->description = $request->description;
        $data->tags = $request->tags;
        $data->status = $request->status;
        $photo = $request->image;

        //__PostProcessed event calling start__\\
        $edata = ['title' => $request->title, 'data' => date('d, F Y', strtotime($request->post_date))];
        event(new PostProcessed($edata)); // PostProcessed event calling end
        dispatch(new PostPodcast($edata));

        // Img function start
        if ($photo) {
            $photoName = $slug . '.' . $photo->getClientOriginalExtension(); // image name like (slug.png)

            // if file exists img will save in this file if file not exist it will first create file then save the img .
            $relPath = 'public/media/';
            if (!file_exists(($relPath))) {
                mkdir(($relPath), 777, true);
            }
            Image::make($photo)->resize(600, 360)->save($relPath . $photoName); // saving resized img in media folder.
            $data->image = $relPath . $photoName; // saving img in database
            $data->save();

            $notification = array(
                'message' => 'Post created successfully!',
                'alert-type' => 'success'
            );
            return redirect()->route('post.index')->with($notification);
        }  // Img function end

        $data->save();
        $notification = array(
            'message' => 'Post created successfully!',
            'alert-type' => 'success'
        );


        return redirect()->route('post.index')->with($notification);
    } // End Mathod



    public function edit($id)
    {
        $categories = Category::all();
        $Post = Post::find($id);
        return view('admin.post.edit', compact('categories', 'Post'));
    } // End Mathod

    public function update(Request $request, $id)
    {
        $data = Post::find($id);

        $validated = $request->validate([
            'category' => 'required',
            'title' => 'required',
            'tags' => 'required',
            'description' => 'required',
        ]);

        $categoryid = DB::table('subcategorieds')->where('id', $request->category)->first()->category_id; // collecting categoryId from Subcatefori table.
        $slug =  Str::slug($request->title, '-');


        $data->category_id = $categoryid;
        $data->subcategory_id = $request->category;
        $data->user_id = Auth::id();
        $data->title = $request->title;
        $data->slug = $slug;
        $data->post_date = $request->post_date;
        // $data->image = $request->image;
        $data->description = $request->description;
        $data->tags = $request->tags;
        $data->status = $request->status;
        $photo = $request->image;

        // Img function start
        if ($photo) {
            // First Deleting existing imge then save new img with old name.
            if (file_exists($request->old_image)) {
                File::delete($request->old_image);
            }

            $photoName = $slug . '.' . $photo->getClientOriginalExtension(); // image name like (slug.png)

            // if file exists img will save in this file if file not exist it will first create file then save the img .
            $relPath = 'media/';
            if (!file_exists(($relPath))) {
                mkdir(($relPath), 777, true);
            }
            Image::make($photo)->resize(600, 360)->save($relPath . $photoName); // saving resized img in media folder.
            $data->image = $relPath . $photoName; // saving img in database
            $data->save();

            $notification = array(
                'message' => 'Post Updated successfully!',
                'alert-type' => 'success'
            );
            return redirect()->route('post.index')->with($notification);
        } else {
            $data->image = $request->old_image;
            $data->save();
            $notification = array(
                'message' => 'Post Updated successfully!',
                'alert-type' => 'success'
            );
            return redirect()->route('post.index')->with($notification);
        }
        // Img function end


    } // End Mathod


    public function destroy($id)
    {
        //__Eleoquent__//
        $post = Post::find($id);

        if (File::exists($post->image)) {
            File::delete($post->image);
        }
        $post->delete();

        //__Query Builder__//
        // $post = DB::table('posts')->where('id', $id)->first();
        // if (File::exists($post->image)) {
        //     File::delete($post->image);
        // }
        // $post = DB::table('posts')->where('id', $id)->delete();


        $notification = array(
            'message' => 'Post deleted successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // End Mathod
}
