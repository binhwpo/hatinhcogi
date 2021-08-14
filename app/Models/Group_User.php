<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group_User extends Model
{
    use HasFactory;
    protected $table = 'group_user';

    /**
     * The roles that belong to the Group_User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permissions::class, 'group_has_permissions', 'group_id', 'permission_id');
    }
}