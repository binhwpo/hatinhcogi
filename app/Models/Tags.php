<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function post()
    {
        return $this->belongsToMany(Posts::class,'post_tags','tag_id','post_id');
    }
}
