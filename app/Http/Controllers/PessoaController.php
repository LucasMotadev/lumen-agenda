<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\PessoaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PessoaController extends Controller
{
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $pessoa = new PessoaModel();
            $pessoa->store($request);
            DB::commit();
            return response()->json(['success' => 'Pessoas casdastrada!'],201);
    
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => $e->getMessage()],400);
        }
    }
}
