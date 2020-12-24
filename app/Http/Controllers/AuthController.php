<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends BaseController
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    private $user;
    public function __construct()
    {

        $this->middleware('auth:api', ['except' => ['login','store','solicitResetPassword']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        try {
            $credentials = ['email'=> $request->email, 'password'=> $request->password];
             
            if (!$token = Auth::attempt($credentials, true)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            $user = User::find(Auth::user()->id);
            $user->token = $token;
            $user->save();
    
            return $this->respondWithToken($token);
            
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Erro ao efetuar login'], 400);
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {   
        return response()->json(Auth::user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {   
        Auth::logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(Auth::refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token, $time = 60)
    {   

        return response()->json([
            'token' => $token,
            'user' => Auth::user()->apelido,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * $time
        ]);
    }

    public function resetPassword(Request $request){
       try {
        $id = Auth::user()->id;
        $user = User::find($id);
        $user->password = Hash::make($request->password);
        $user->save();
        Auth::logout();
        return response()->json(['success' => 'Senha cadastrada com sucesso!'], 201);
       } catch (\Throwable $th) {
        return response()->json(['error' => 'erro ao atualza dados'], 400);
       }
    }

}