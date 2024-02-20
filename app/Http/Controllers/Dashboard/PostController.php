<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use inertia\inertia;

class PostController extends Controller
{
    public function Index()
    {
        return inertia::render('Dashboard/Post/Index') ;
        
       
    }
    
}
