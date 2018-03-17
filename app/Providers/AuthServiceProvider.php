<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {

        $this->registerPolicies($gate);
        //更新文章权限验证
        $gate->before(function ($user) {
            if ($user->auth === 5) {
                return true;
            }
        });
        //文章更新验证
        $gate->define('update', function ($user, $post) {
            return $user->id == $post->user_id;
        });
        //操作权限验证
        $gate->define('admin', function ($user, $auth) {
            return $user->auth == $auth;
        });
    }
}
