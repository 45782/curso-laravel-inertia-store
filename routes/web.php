<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\PostController;
use Doctrine\DBAL\Schema\Index;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


 Route::get('/', function () {
     return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
   ]);
 });
  
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::prefix('category')->namespace('Category')->group(function() {
        Route::get('create', [CategoryController::class, 'create'])->name('create');
        Route::get('index', [CategoryController::class, 'index'])->name('category.index');
        Route::get('edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::post('store', [CategoryController::class, 'store'])->name('category.store');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
    });
    Route::get('Post', [PostController::class, 'Create'])->name('post.create');
    Route::post('store', [PostController::class, 'store'])->name('post.store');
    Route::get('index', [PostController::class, 'index'])->name('post.index');
    Route::get('edit/{post}', [PostController::class, 'edit'])->name('post.edit');
     

    Route::post('/post/update/{post}', [PostController::class, 'upload'])->name('post.upload');
    // Route::put('update', [PostController::class, 'update'])->name('post.update');
    Route::put('posts/{post}', [PostController::class, 'update'])->name('post.update');
    Route::get('save/{post}', [PostController::class, 'edit'])->name('posts.save');
    Route::get('save/{post}', [PostController::class, 'index'])->name('posts.save');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::delete('/posts/image/delte/{post}', [PostController::class, 'imageDelete'])->name('post.image-delete');







});


