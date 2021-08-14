<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Provinces;
use App\Models\Wards;

class Districts extends Model
{
    use HasFactory;

    // public function province()
    // {
    //     return $this->belongsTo(Provinces::class, config('vietnam-maps.columns.province_id'), 'id');
    // }

    public function wards()
    {
        return $this->hasMany(Wards::class, 'district_id', 'id');
    }
}
