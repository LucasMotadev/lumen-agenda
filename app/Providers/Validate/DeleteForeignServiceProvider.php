<?php

namespace App\Providers\Validate;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class DeleteForeignServiceProvider extends ServiceProvider
{
    private $request;

    public function boot(Request $request)
    {
        $this->request = $request->all();
        Validator::extend(
            'delete_foreign',
            function ($attribute, $value, $parameters, $validator) {

                for ($i = 0; $i < count($parameters); $i++) {

                    $table = DB::table($parameters[$i])
                        ->where($parameters[$i = $i + 1], $value);

                    if ($table->count()) return false;
                }

                return true;
            },
            'O recuro possui registro vinculado'
        );
    }

    public function register()
    {
        //
    }
}
