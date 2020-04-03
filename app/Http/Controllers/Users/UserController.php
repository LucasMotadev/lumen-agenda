<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\User;
use App\Utils\Email;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends AuthController
{

    public  function create(Request $request)
    {
        try {

            $user = new User();
            $user->pessoa_id = $request->pessoa_id;
            $user->apelido = $request->apelido;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            return response()->json(['success' => 'Usuario criado com sucesso']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao criar usuario'], 400);
        }
    }

    public function solicitResetPassword(Request $request){
        try {
            $email = new Email([
                'server' => env('EMAIL_SERVER'),
                'user'   => env('EMAIL_USER'),
                'pw'     => env('EMAIL_PW'),
                'port'   => env('EMAIL_PORT')      
            ]);
    
        
            $user = User::where('email', $request->email)->first();
            if(!$user){
                return response()->json(['error' => 'Email não cadastrado!'],400);
            }

            $token =  Auth::login($user);
            $token =  $this->respondWithToken($token, 2);
            $token = $token->original['token'];
            
            $msg = '<h2>Clik no link para redefinir sua senha</h2> <a hr> <a href="http://10.0.0.100:8080/reset/password/'.$token.'" class="btn btn-primary">Confirmar</a>';
            $email->send($request->email,'Solicitação para redefinição de senha',$msg );
            return response()->json(['success' => 'Email enviado!'],200);
    
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao  enviar email pra redefinir senha'],400);
        }
    }


}
