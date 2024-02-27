<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\Put;
use App\Http\Requests\Post\Store;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

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
        return inertia("Dashboard/Post/Create");
    }

    public function store(Store $request)
    {
        Post::create($request->validated());
        return redirect()->route('post.index')->with('message', "Created Post successfully");
    }


    public function edit(post $post)
    {
        // sleep(3);
        $categories = Category::get();
        return inertia("Dashboard/Post/Edit", compact('post', 'categories'));
    }
    public function update( Request $request,Post $Post)
    {
        $Post->update($request->validated());
        return  redirect()->route('post.index')-> with('message,"Updatep Post successfully');
    }
    public function destroy(Post $Post)
    {
        $Post->delete();
        return to_route ('Post.index')-> with('message,"delete Post successfully');;
    }
}