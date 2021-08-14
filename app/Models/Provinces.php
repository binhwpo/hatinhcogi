<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Districts;

class Provinces extends Model
{
    use HasFactory;

    /**
     * Get all of the comments for the Provinces
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function districts()
    {
        return $this->hasMany(Districts::class, 'province_id', 'id');
    }
}
