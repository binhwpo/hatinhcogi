<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    /**
     * Get the user associated with the Media
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ftp()
    {
        // return $this->hasOne(FTP::class, 'id', 'fpt_id');
        return $this->hasOne('App\Models\FTP', 'id', 'fpt_id');
    }

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}
