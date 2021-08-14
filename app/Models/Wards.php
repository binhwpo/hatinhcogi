<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Districts;

class Wards extends Model
{
    use HasFactory;

    public function district()
    {
        return $this->belongsTo(Districts::class, config('vietnam-maps.columns.district_id'), 'id');
    }
}
