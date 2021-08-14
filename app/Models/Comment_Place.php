<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment_Place extends Model
{
    use HasFactory;
    protected $table = 'comment_place';

    protected $casts = [
        'media' => 'array',
    ];


    /**
     * Get the user associated with the Comment_Place
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
