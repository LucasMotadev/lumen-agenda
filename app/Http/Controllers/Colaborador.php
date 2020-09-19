<?php

namespace App\Http\Controllers;

use App\Model\Colaborador;

class ColaboradorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct(Colaborador::class);
    }

    //
}
