<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Model\PessoaModel;
use App\Utils\Email;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PessoaController extends AuthController
{

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $pessoa = new PessoaModel();
            $pessoa->store($request);
            $request->password = 'senha_padrao_para_pre_cadastro_de_usuarios';
            $token = $this->login($request);
        
            if($token->original['token']){
                $this->emailConfirmacao($request, $token->original['token']);  
                DB::commit();
                return response()->json(['success' => 'Pessoas casdastrada, cheque sua caixa de entrada!'],201);
            }
           DB::rollback();
           throw new Exception('Error ao cadastrar ente mais tarde!');
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => $e->getMessage()],400);
        }
    }

    public function emailConfirmacao(Request $request,$token){

        $email = new Email([
            'server' => 'smtp.live.com',
            'user'   => 'lukasmotta.8@hotmail.com',
            'pw'     => 'lukas@vidaloka157',
            'port'   => 587      
        ]);


         $msg = ' 
            <html>
                <header>
                    <h3>Confirmação de Cadastro</h3>
                </header>
                <p >Caso não tenha solicitado, por gentileza iguinorar esse email!</p>
                <body>
                        <div class="card text-center">
                            <div class="card-header">
                            Confimação de Cadastro
                            </div>
                            <div class="card-body">
                            <h5 class="card-title">Barberaria doBlack</h5>
                            <p class="card-text">Clink no link para cofirmar o cadastro!</p>
                            <a href="http://10.0.0.100:8080/reset/password/'.$token.'" class="btn btn-primary">Confirmar</a>
                            </div>
                        <div class="card-footer text-muted">
                          Data da Solicitação: 
                        </div>
                      </div>
                </<body>
            </htm>
            <style>

            </style>
       
        ';

        $email->send($request->email,'Confirmação de Cadastro',$msg);

    }
}
