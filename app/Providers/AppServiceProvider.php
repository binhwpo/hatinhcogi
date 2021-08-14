<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\Frontend\WeatherController;
use App\Library\Services\DemoOne;

use App\Models\Posts;
use App\Models\Categories;
use App\Models\Provinces;
use App\Models\FTP;
use App\Models\Media;
use App\Models\Icon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        view()->composer('*',function($view){
            $view->with([
                'dataunique_category' => Categories::whereNull('parent_id')->where('status',1)->get(),
                'dataunique_category_post' => Categories::where('slug','bai-viet')->where('status',1)->get(),
                'data_hatinh' => Provinces::find(28),
                'listftp' => FTP::where('status', 1)->get(),
                'media_unique' => Media::where('type', 'img')->orderBy('id', 'DESC')->get(),
                'icon' => Icon::orderBy('id', 'DESC')->get(),
            ]);
        });
    }
}
