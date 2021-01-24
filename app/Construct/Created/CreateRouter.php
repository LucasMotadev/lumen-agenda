<?php
namespace App\Construct\Created;

use App\Construct\Model\Tables;

class CreateRouter {

    public function showAll(){

        $response = Tables::where('table_schema', 'database')->get();
        dd($response);
    }
}