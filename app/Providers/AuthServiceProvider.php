<?php

namespace App\Providers;

use App\Model\Pessoa;
use App\Policies\PessoaPolicy;
use App\User;
use Illuminate\Support\Facades\Gate;
use Laravel\Lumen\Auth\Authorizable;
use Tymon\JWTAuth\Providers\LumenServiceProvider;

class AuthServiceProvider extends LumenServiceProvider
{
    use Authorizable, Authorizable;
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
    }
    
    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        
        $this->app['auth']->viaRequest('api', function ($request) {
            return app('auth')->setRequest($request)->user();
        });

    }
}
