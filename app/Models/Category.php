<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillabe =['title','slug','image','text'];
    public function post()
    {
        $this->hasMany(post::class);
    }
}
