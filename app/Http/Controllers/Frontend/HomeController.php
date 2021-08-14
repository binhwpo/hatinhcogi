<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\WeatherController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Posts;
use App\Models\Places;
use App\Models\Categories;
use App\Models\User;

class HomeController extends Controller
{

    public function __construct(WeatherController $weatherController)
    {
        $this->weatherController = $weatherController;
    }

    public function index()
    {
        $weather = $this->weatherController->getWeather();
        
        $cate_post = Categories::where('slug','bai-viet')->where('status',1)->first();
        $category_post = Categories::where('parent_id', $cate_post->id)->where('status',1)->limit(4)->get();

        $post_hot = Posts::where('status', 1)->where('type', 1)->orderby('view','DESC')->limit(2)->get();

        $post = Posts::where('status', 1)->get();
        if(count($post) >= 6){
            $num = floor(count($post)/6);
            if ($num > 3) {
                $num = 3;
            }
            $num = $num * 6;
            $post_trending = Posts::where('status', 1)->orderby('view','DESC')->limit(8)->get();
        } else {
            $post_trending = Posts::where('status', 1)->orderby('view','DESC')->limit(4)->get();
        }

        $places = Places::where('status', 1)->get();
        if(count($places) >= 6){
            $num = floor(count($post)/6);
            if ($num > 3) {
                $num = 3;
            }
            $num = $num * 6;
            $place_trending = Places::where('status', 1)->limit($num)->get();
        } else {
            $place_trending = Places::where('status', 1)->limit(4)->get();
        }

        $arrauthor = array();
        $arrid = array();
        $users = User::all();
        foreach ($users as $key => $value) {
            if (count($value->posts) >= 4) {
                $arrauthor[count($value->posts)] = $value;
            }
        }

        krsort($arrauthor);

        return view('frontend.home.home', compact('weather', 'category_post', 'post_hot', 'post_trending', 'place_trending', 'arrauthor'));
    }

    public function page404()
    {
        return view('frontend.page.404');
    }
    
}
