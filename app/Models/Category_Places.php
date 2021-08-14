<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category_Places extends Model
{
    use HasFactory;
    protected $table = 'category_places';

    public $timestamps = false;
}
