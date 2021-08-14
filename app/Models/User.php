<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Models\Posts;
use App\Models\Group_User;
use App\Models\Permissions;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'provider',
        'provider_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Posts::class ,'user_create','id');
    }

    public function posts_trending()
    {
        return Posts::where('user_create', $this->id)->where('status', 1)->orderby('view', 'DESC')->limit(4)->get();
    }

    /**
     * Get the user associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function group()
    {
        return $this->hasOne(Group_User::class, 'id', 'group_id');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permissions::class, 'user_has_permissions', 'user_id', 'permission_id');
    }

    public function checkPemissionAccess($check)
    {
        $user = auth()->user();
        if (!empty($user)) {
            $permissions = $user->permissions;
            $gpermissions = $user->group->permissions;
            if ($permissions->contains('slug', $check) || $gpermissions->contains('slug', $check)) {
                return true;
            }
            return false;
        } else {
            return false;
        }
    }
}
