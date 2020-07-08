<?php

namespace App\Http\Controllers;

use App\ServicoCategoria;
use Illuminate\Http\Request;

class ServicoCategoriaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function show()
    {
        try {

            $categorias = ServicoCategoria::all();
            return response()->json($categorias, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'error ao listar'], 400);
        }
    }

    public function store(Request $request){
        $this->validate($request,[
            'descricao' => 'required|unique:servicos_categorias'
        ],
        [
            'descricao'=> 'Error  null'
        ]
        );
        try {

            $categorias = new ServicoCategoria();
            $categorias->descricao = $request->descricao;
            $categorias->save();

            return response()->json(['success' => 'Categoria cadastrado com sucesso'], 200);
        } catch (\Exception $e) {

            return response()->json(['error' => $e-> getMessage()], 400);
        }
    }
    
    public function update(Request $request){

        $this->validate($request,[
            'descricao' => 'required|unique:servicos_categorias'
        ]);
        try {
            $categorias =  ServicoCategoria::find($request->id);
            $categorias->descricao = $request->descricao;
            $categorias->save();
            return response()->json($categorias, 200);
        } catch (\Exception $e) {

            return response()->json(['error' => $e-> getMessage()], 400);
        }
    }

    //
}
