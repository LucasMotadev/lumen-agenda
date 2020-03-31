<?php
namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {

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
            return response()->json(['error' => 'Erro ao criar usuario'],400);
        }
    }
}