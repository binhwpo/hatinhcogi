<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Categories extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'description',
        'icon',
        'slug',
    ];

    public function categories()
    {
        return $this->hasMany('App\Models\Categories', 'parent_id', 'id');
    }

    public function childrenCategories()
    {
        return $this->hasMany('App\Models\Categories', 'parent_id', 'id');
    }

}
