<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// FrontendController
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Frontend\SocialAuthController;

// FrontendController
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\FTPController;
use App\Http\Controllers\Admin\AjaxController;
use App\Http\Controllers\Admin\RepositoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth
Auth::routes();

Route::get('/auth/{provider}', [SocialAuthController::class, "redirectToProvider"])->name('authsocial');

Route::get('/auth/{provide}/callback', [SocialAuthController::class, "handleProviderCallback"]);

// Trang chủ
Route::get('/', [HomeController::class, "index"])->name('home');

Route::get('/page/404', [HomeController::class, "page404"])->name('404');

Route::get('/{slug}', [PostController::class, "detailpost"])->name('detailpost');

// Bài viết
Route::group(['prefix' => 'bai-viet'], function() {
    Route::get('/danh-sach', [PostController::class, "allpost"])->name('allpost');

    Route::get('/{slug}', [PostController::class, "detailcategory"])->name('detailcategory');

    Route::get('/tac-gia/{username}', [PostController::class, "detailauthor"])->name('detailauthor');
});

Route::middleware(['auth'])->group(function () {

    // Thư viện
    Route::group(['prefix' => 'media', 'as' => 'media.', 'name' => 'media'], function() {
        Route::post('/loadmedia', [MediaController::class, "loadmedia"])->name('loadmedia');

        Route::post('/loadicon', [MediaController::class, "loadicon"])->name('loadicon');
        Route::post('/saveicon', [MediaController::class, "saveicon"])->name('saveicon');
    
        Route::post('/loaddetailmedia', [MediaController::class, "loaddetailmedia"])->name('loaddetailmedia');
    
        Route::post('/filtermedia', [MediaController::class, "filtermedia"])->name('filtermedia');
    
        Route::post('/uploadmedia', [MediaController::class, "uploadmedia"])->name('uploadmedia');
    
        Route::get('/delete', [MediaController::class, "delete"])->name('delete');
    });

    Route::group(['prefix' => 'admin', 'middleware' => 'checkadmin'], function() {
        Route::get('/dashboard', [DashboardController::class, "index"])->name('dashboard');

        // Quản lí thư viện
        Route::group(['prefix' => 'media', 'as' => 'media.', 'name' => 'media'], function() {
            Route::get('/', [MediaController::class, "index"])->name('index');

            Route::post('/uploadmedia', [MediaController::class, "uploadmediaadmin"])->name('uploadmediaadmin');

            Route::post('/delete', [MediaController::class, "delete"])->name('delete');
        });
        
        // Trang quản lý danh mục
        Route::group(['prefix' => 'category', 'as' => 'category.', 'name' => 'category'], function() {
            Route::get('/', [CategoryController::class, "index"])->name('index')->middleware('can:view-category');;

            Route::get('/add', [CategoryController::class, "create"])->name('add');
            Route::post('/add', [CategoryController::class, "store"])->name('postadd');

            Route::get('/edit', [CategoryController::class, "edit"])->name('edit');
            Route::post('/edit/{id}', [CategoryController::class, "update"])->name('postedit');

            Route::get('/delete/{id}', [CategoryController::class, "destroy"])->name('delete');
        });
        
        // Trang quản lý bài viết
        Route::resource('post', 'App\Http\Controllers\Admin\PostController');

        // Trang quản lý địa điểm
        Route::resource('place', 'App\Http\Controllers\Admin\PlaceController');

        // Trang quản lý đường dẫn
        Route::resource('slug', 'App\Http\Controllers\Admin\SlugController');

        // Trang quản lý tài khoản người dùng
        Route::resource('user', 'App\Http\Controllers\Admin\UserController');

        // Trang quản lý nhóm tài khoản
        Route::resource('group', 'App\Http\Controllers\Admin\GroupController');
        
        // Trang quản lý page
        Route::resource('page', 'App\Http\Controllers\Admin\PageController');

        // Trang quản lý tài khoản ftp
        Route::group(['prefix' => 'accountftp', 'as' => 'accountftp.', 'name' => 'accountftp'], function() {
            Route::get('/', [FTPController::class, "index"])->name('index');

            Route::post('/add', [FTPController::class, "store"])->name('store');

            Route::get('/editftp', [FTPController::class, "edit"])->name('edit');
            Route::post('/edit/{id}', [FTPController::class, "update"])->name('postedit');

            Route::get('/delete/{id}', [FTPController::class, "destroy"])->name('destroy');
        });

        // Ajax
        Route::group(['prefix' => 'ajax', 'as' => 'ajax.', 'name' => 'ajax'], function() {
            Route::post('/loadpermission', [AjaxController::class, "loadpermission"])->name('loadpermission');

            Route::post('/addfastcategoryplace', [AjaxController::class, "addfastcategoryplace"])->name('addfastcategoryplace');

            Route::post('/addfastcategorypost', [AjaxController::class, "addfastcategorypost"])->name('addfastcategorypost');

            Route::post('/addfastservices', [AjaxController::class, "addfastservices"])->name('addfastservices');
        });
    });
});