<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Has_Permissions extends Model
{
    use HasFactory;
    protected $table = 'user_has_permissions';
    public $timestamps = false;
}
