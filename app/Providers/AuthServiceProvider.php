<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('view-dashboard',function ($user){
            return $user->checkPemissionAccess('view-dashboard');
        });

        Gate::define('view-support',function ($user){
            return $user->checkPemissionAccess('view-support');
        });

        Gate::define('ref-support',function ($user){
            return $user->checkPemissionAccess('ref-support');
        });

        Gate::define('delete-support',function ($user){
            return $user->checkPemissionAccess('delete-support');
        });

        Gate::define('view-category',function ($user){
            return $user->checkPemissionAccess('view-category');
        });

        Gate::define('add-category',function ($user){
            return $user->checkPemissionAccess('add-category');
        });

        Gate::define('edit-category',function ($user){
            return $user->checkPemissionAccess('edit-category');
        });

        Gate::define('delete-category',function ($user){
            return $user->checkPemissionAccess('delete-category');
        });

        Gate::define('view-post',function ($user){
            return $user->checkPemissionAccess('view-post');
        });

        Gate::define('add-post',function ($user){
            return $user->checkPemissionAccess('add-post');
        });

        Gate::define('edit-post',function ($user){
            return $user->checkPemissionAccess('edit-post');
        });

        Gate::define('delete-post',function ($user){
            return $user->checkPemissionAccess('delete-post');
        });

        Gate::define('view-place',function ($user){
            return $user->checkPemissionAccess('view-place');
        });

        Gate::define('add-place',function ($user){
            return $user->checkPemissionAccess('add-place');
        });

        Gate::define('edit-place',function ($user){
            return $user->checkPemissionAccess('edit-place');
        });

        Gate::define('delete-place',function ($user){
            return $user->checkPemissionAccess('delete-place');
        });

        Gate::define('view-group',function ($user){
            return $user->checkPemissionAccess('view-group');
        });

        Gate::define('add-group',function ($user){
            return $user->checkPemissionAccess('add-group');
        });

        Gate::define('edit-group',function ($user){
            return $user->checkPemissionAccess('edit-group');
        });

        Gate::define('delete-group',function ($user){
            return $user->checkPemissionAccess('delete-group');
        });

        Gate::define('view-user',function ($user){
            return $user->checkPemissionAccess('view-user');
        });

        Gate::define('add-user',function ($user){
            return $user->checkPemissionAccess('add-user');
        });

        Gate::define('edit-user',function ($user){
            return $user->checkPemissionAccess('edit-user');
        });

        Gate::define('delete-user',function ($user){
            return $user->checkPemissionAccess('delete-user');
        });

        Gate::define('view-userftp',function ($user){
            return $user->checkPemissionAccess('view-userftp');
        });

        Gate::define('add-userftp',function ($user){
            return $user->checkPemissionAccess('add-userftp');
        });

        Gate::define('edit-userftp',function ($user){
            return $user->checkPemissionAccess('edit-userftp');
        });

        Gate::define('delete-userftp',function ($user){
            return $user->checkPemissionAccess('delete-userftp');
        });

        Gate::define('view-slug',function ($user){
            return $user->checkPemissionAccess('view-slug');
        });

        Gate::define('delete-slug',function ($user){
            return $user->checkPemissionAccess('delete-slug');
        });

        Gate::define('view-permission',function ($user){
            return $user->checkPemissionAccess('view-permission');
        });

        Gate::define('add-permission',function ($user){
            return $user->checkPemissionAccess('add-permission');
        });

        Gate::define('edit-permission',function ($user){
            return $user->checkPemissionAccess('edit-permission');
        });

        Gate::define('delete-permission',function ($user){
            return $user->checkPemissionAccess('delete-permission');
        });

        Gate::define('view-comment',function ($user){
            return $user->checkPemissionAccess('view-comment');
        });

        Gate::define('add-comment',function ($user){
            return $user->checkPemissionAccess('add-comment');
        });

        Gate::define('edit-comment',function ($user){
            return $user->checkPemissionAccess('edit-comment');
        });

        Gate::define('delete-comment',function ($user){
            return $user->checkPemissionAccess('delete-comment');
        });
    }
}
