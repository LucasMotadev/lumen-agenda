<?php

namespace App\Http\Controllers;

use App\Servico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServicoController extends Controller
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

    public function show(Request $request)
    {
        try {
  
            $where = [];
            foreach ($request->all() as $key => $value) {
              $where[$key] = $value;  
            }

            $servico = DB::table('vw_servico')->where($where);
            $result = $servico->get();
            
            return response()->json($result, 200);
        } catch (\Exception  $e) {
            return response()->json(['error' => 'Erro ao consultar'. $e->getMessage()], 400);
        }
    }

    public function store(Request $request)
    {

        $this->validate($request,[
            'descricao' => 'required|unique:servicos',
            'categoria_id' => 'required',
            'tempo_execulcao' => 'required'
        ],[
            'required' => 'O campo :attribute é obrigatório',
            'unique' => 'O servico :attribute já esta cadastrado',
        ], [
            'descricao'         => $request->descricao,
            'categoria_id'      => 'Categoria',
            'tempo_execulcao'   => 'Tempo Duração',
        ]);

        try {
          //  return 'teste';
            $servico = new Servico();
            $servico->descricao = $request->descricao;
            $servico->tempo_execulcao = $request->tempo_execulcao;
            $servico->tempo_ocioso = $request->tempo_ocioso;
            $servico->valor = $request->valor;
            $servico->categoria_id = $request->categoria_id;
            $servico->save();
            return response()->json(['success' => 'Dados persistidos']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao persistir: '. $e->getMessage()], 400);
        }
    }

    public function update(Request $request){
        
        $this->validate($request,[
            'servico_id' => 'required',
            'categoria_id' => 'required'
           
        ],[
            'required' => 'O campo :attribute é obrigatório',
    
        ], [
            'servico_id'   => 'Descricao ',
            'categoria_id' => 'Categoria'
            
        ]);
       
       try {
        $servico = Servico::find($request->servico_id);
        
        $servico->descricao = $request->descricao;
        $servico->tempo_execulcao = $request->tempo_execulcao;
        $servico->tempo_ocioso = $request->tempo_ocioso;
        $servico->valor = $request->valor;
        $servico->categoria_id = $request->categoria_id;
        $servico->save();

        return response()->json(['success' => 'Dados atualizados']);
       } catch (\Exception $e) {
         return response()->json(['error' => 'Erro ao atualizar: '. $e->getMessage()], 400);
       }
        
    }

    public function delete(Request $request){

        try {
            $servico = Servico::find($request->id);
            $servico->delete();
            return response()->json(['success' => 'Servico deletado com sucesso!' ]);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Erro ao deletar Servico!' ]);
        }
    }

    //
}
