<?php

namespace App\Http\Controllers;

use App\Model\Cliente;
use App\Model\Pessoa;
use App\Model\Telefone;
use App\Model\Email;
use App\Model\PessoasFisica;
use App\Model\PessoasJuridica;
use App\Model\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PessoaController extends AuthController
{
    private $idPessoa;
    public function show(){
        try {
            $table = DB::table('vw_pessoas');


            $pessoa =  $table->get();
            return response()->json($pessoa);
            
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            $pessoa                     = new Pessoa();
            $pessoa->nome               = $request->nome;
            $pessoa->codigo             = $request->codigo;
            $pessoa->data_nascimento    = $request->data_nascimento; 
            $pessoa->save();
            $this->idPessoa = $pessoa->id;
            
            $telefone = new Telefone();
            $telefone->numero = $request->numero;
            $telefone->pessoa_id =  $pessoa->id;
            $telefone->save();

            $email = new Email();
            $email->email       = $request->email;
            $email->pessoa_id   = $pessoa->id;
            $email->save();

            $cliente = new Cliente();
            $cliente->pessoa_id = $pessoa->id;
            $cliente->limite_credito = 00.00;
            $cliente->save();

            $user = new User();
            $user->pessoa_id = $pessoa->id;
            $user->apelido = $request->apelido;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            $codigo  = preg_replace('/\W/', '', $request->codigo);
            if (strlen($codigo) == 11) return $this->pessoaFisicaStore($request);
            if (strlen($codigo) == 14) return $this->pessoaJuridicaStore($request);
            
            
            DB::commit();
          
           return response()->json(['success' => 'Pessoa cadastrada com sucesso!']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }


    public function pessoafisicaStore(Request $request)
    {
        $pessoaFisica                   = new PessoasFisica();
        $pessoaFisica->pessoa_id        = $this->idPessoa;
        $pessoaFisica->data_nascimento  = $request->data_nascimento;
        $pessoaFisica->rg               = $request->rg;
        $pessoaFisica->sexo_id          = $request->sexo;
        $pessoaFisica->save();
    }


    public function pessoaJuridicaStore(Request $request)
    {   
        $pessoaJuridica = new PessoasJuridica();
        $pessoaJuridica->nome_fantasia = $request->nome_fantasia;
        $pessoaJuridica->pessoa_id = $this->idPessoa;
        $pessoaJuridica->save();
    }
  
}
