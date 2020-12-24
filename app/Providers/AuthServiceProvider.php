<?php

namespace App\Providers;

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
        //
       
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {

        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.
        
       // Auth::viaRequest('api', function ($request) {
         //   dd('test');
        //    return User::where('id',Auth::user()->id)
         //   ->where('token', $request->token);

       // });
     
         $this->app['auth']->viaRequest('api', function ($request) {
             echo 'teste do token ';
             if ($request->token) {
                 echo  'teste de authserive';
                 return User::where('token', $request->input('token'))->first();
             }
         });
    }
}
