<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\Put;
use App\Http\Requests\Post\Store;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{

    public function index()
    {
        $categories = Post::paginate();
        return inertia("Dashboard/Post/Index", compact("categories"));
        // return response()->json($categories);
    }

    public function Create()
    {
        $categories = Category::get();
        return inertia("Dashboard/Post/Save", compact("categories"));
    }

    public function store(Store $request)
    {
       $post = Post::create($request->validated());
        $this->upload($request, $post);
        return redirect()->route('post.index')->with('message', "Created Post successfully");
    }


    public function edit(Post $post)
    {
        // sleep(3);
        $categories = Category::get();
         return inertia("Dashboard/Post/Save", compact('post', 'categories'));
    }

    public function update(Put $request, Post $post)
    {
        $post->update($request->validated());
        $this->upload($request, $post);
        return redirect()->route('post.index');
    }
    public function destroy(Post $post)
    {
        $post->delete();
        return to_route('post.index')->with('message', "Deleted post successfully");
    }

    public function upload(Request $request, Post $post)
    {
        $request->validate(
            [
                'image' => 'required|mimes:jpg,jpeg,png,gif|max:10240'
            ]
        );

        Storage::disk("public_upload")->delete("image/post/" . $post->image);

        $data['image'] = $filename = time() . "." . $request['image']->extension();

        $request->image->move(public_path("image/post"), $filename);

        $post->update($data);

        return to_route('post.index')->with('message', "Upload image to post successfully");
    }

    public function imageDelete(Post $post)
    {
        Storage::disk("public_upload")->delete("image/post/" . $post->image);
        $post->update(['image' => '']);
        return to_route('post.edit', $post->id)->with('message', "image removed to post successfully");
    }
} 