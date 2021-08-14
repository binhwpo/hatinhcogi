<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place_Tags extends Model
{
    use HasFactory;

    protected $table = 'place_tags';
    public $timestamps = false;
}
