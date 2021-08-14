<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'contents',
        'featured_image',
    ];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_create');
    }

    public function slug()
    {
        return $this->hasOne('App\Models\Slug', 'id', 'slug_id');
    }

    public function place()
    {
        return $this->hasOne('App\Models\Places', 'id', 'place_id');
    }

    public function category()
    {
        return $this->belongsToMany(Categories::class,'category_posts','post_id','category_id');
    }

    public function tag()
    {
        return $this->belongsToMany(Tags::class,'post_tags','post_id','tag_id');
    }

    public function relatedpost($number)
    {
        $tagid = array();
        $postid = array();
        foreach ($this->tag as $item) {
            array_push($tagid, $item->id);
        }
        $poststest = Posts::join('post_tags', 'posts.id', '=', 'post_tags.post_id')->whereIn('tag_id', $tagid)->get();
        foreach ($poststest as $post) {
            $check = 1;
            foreach ($postid as $item) {
                if ($post->id == $item) {
                    $check = 0;
                }
            }

            if ($post->id == $this->id) {
                $check = 0;
            }

            if ($check == 1) {
                array_push($postid, $post->id);
            }
        }
        return $posts = Posts::whereIn('id',$postid)->orderby('id', 'DESC')->limit($number)->get();
    }
}
