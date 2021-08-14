<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pipeline\Pipeline;

class Places extends Model
{
    use HasFactory;

    public static function filterPlace($request) {
        $places = Places::query();

        $pipeline = app(Pipeline::class)
            ->send($places)
            ->through([
                \App\QueryFilters\Active::class,
                \App\QueryFilters\Sort::class,
                \App\QueryFilters\Area::class
            ])
            ->thenReturn();
        return $pipeline->paginate(12);
    }

    protected $fillable = [
        'place_name',
        'cover_image',
        'description',
        'slug',
    ];

    protected $casts = [
        'information' => 'array',
        'media' => 'array',
        'schedule' => 'array',
        'service' => 'array',
    ];
    
    public function comments()
    {
        return $this->hasMany('App\Models\Comment_Place', 'place_id', 'id');
    }

    public function posts()
    {
        return $this->hasMany('App\Models\Posts', 'place_id', 'id');
    }

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_created');
    }

    public function category()
    {
        return $this->belongsToMany(Categories::class,'category_places','place_id','category_id');
    }

    public function tag()
    {
        return $this->belongsToMany(Tags::class,'place_tags','place_id','tag_id');
    }
}
