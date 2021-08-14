<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slug extends Model
{
    use HasFactory;
    protected $table = 'slug';

    public function page()
    {
        return $this->hasOne('App\Models\Page', 'id', 'page_id');
    }
}
