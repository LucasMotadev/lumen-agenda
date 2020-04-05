<?php

namespace App\Http\Controllers;

use App\AgendamentoStatus;

class AgengamentoStatusController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         
    }

    public function show(){

      try {
          
        $agendamentoStatus = AgendamentoStatus::all();
        return response()->json($agendamentoStatus,200);
        
    } catch (\Exception $e) {
        return response()->json(['error'=> 'error ao listar'],400);
      }
        
    }
}
