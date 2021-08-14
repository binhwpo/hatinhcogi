<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group_Has_Permissions extends Model
{
    use HasFactory;
    protected $table = 'group_has_permissions';
    public $timestamps = false;
}
