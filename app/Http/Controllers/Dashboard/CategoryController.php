<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\Put;
use App\Http\Requests\Category\Store;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    
    public function index()
    {
        $categories = Category::paginate();
        return inertia("Dashboard/Category/Index", compact("categories"));
        // return response()->json($categories);
    }

    public function Create()
    {
        return inertia("Dashboard/Category/Create");
    }

    public function store(Store $request)
    {
        Category::create($request->validated());
        return to_route('category.index')->with('message', "Created category succesfully");
    }
    
    public function edit(Category $category)
    {
        // sleep(3);
        return inertia("Dashboard/Category/Edit", compact('category'));
    }

    public function update( Request $request, Category $category)
    {
        $category->update($request->validated());
        return  redirect()->route('category.index')-> with('message,"Updatep category successfully');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return Redirect::route('category.index')->with('message', "Categoría eliminada correctamente.");
    }
    
}