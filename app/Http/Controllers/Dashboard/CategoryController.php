<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\Store;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    
    public function create()
    {
        return inertia("dashboard.category.create");
    }

    public function store(Store $request)
    {
       Category::create($request->validated());
      
    }

    
     
   
    

}