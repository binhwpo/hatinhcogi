<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category_Posts extends Model
{
    use HasFactory;
    protected $table = 'category_posts';

    public $timestamps = false;
}
