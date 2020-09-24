<?php
namespace App\Construct\Controller;

use App\Construct\Model\Tables;

class CreateRouter {

    public function showAll(){

        $response = Tables::where('table_schema', 'database')->get();
        dd($response);
    }
}