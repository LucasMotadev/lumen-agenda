<?php

namespace App\Model;
use Illuminate\Support\Facades\Auth;
use App\Cliente;
use App\Email;
use App\Model\Email as EmailSend;
use App\Pessoa;
use App\PessoasFisica;
use App\PessoasJuridica;
use App\Telefone;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PessoaModel
{
    private $idPessoa;

    public function pessoaStore(Request $request)
    {
        $pessoa             = new Pessoa();
        $pessoa->nome       = $request->nome;
        $pessoa->codigo     = $request->codigo;
        $pessoa->save();
        $this->idPessoa     = $pessoa->id;    
        $this->storeEmial($request);
        $this->storeTelefone($request);
        $this->storeCliente();
        $this->storeUser($request);

    }

    public function storeTelefone(Request $request){
        $telefone = new Telefone();
        $telefone->numero = $request->numero;
        $telefone->pessoa_id =  $this->idPessoa;
        $telefone->save();
    }
    public function storeEmial(Request $request){
        $email = new Email();
        $email->email       = $request->email;
        $email->pessoa_id   =  $this->idPessoa;
        $email->save();
    }
    public function storeCliente(){
        $cliente = new Cliente();
        $cliente->pessoa_id = $this->idPessoa;
        $cliente->limite_credito = 00.00;
        $cliente->save();
    }

    public function pessoaFisicaStore(Request $request)
    {
        $this->pessoaStore($request);
        $pessoaFisica                   = new PessoasFisica();
        $pessoaFisica->pessoa_id        = $this->idPessoa;
        $pessoaFisica->data_nascimento  = $request->data_nascimento;
        $pessoaFisica->rg               = $request->rg;
        $pessoaFisica->sexo_id          = $request->sexo;
        $pessoaFisica->save();
    }

    public function storeUser($request){
        $user = new User();
        $user->pessoa_id = $this->idPessoa;
        $user->apelido = $request->apelido;
        $user->email = $request->email;
        $user->password = Hash::make('senha_padrao_para_pre_cadastro_de_usuarios');
        $user->save();
    }

    public function pessoaJuridicaStore(Request $request)
    {   
        $this->pessoaStore($request);
        $pessoaJuridica = new PessoasJuridica();
        $pessoaJuridica->nome_fantasia = $request->nome_fantasia;
        $pessoaJuridica->pessoa_id = $this->idPessoa;
        $pessoaJuridica->save();
    }

    public function store(Request $request)
    {
        $value  = preg_replace('/\W/', '', $request->codigo);
        if (strlen($value) == 11) return $this->pessoaFisicaStore($request);
        if (strlen($value) == 14) return $this->pessoaJuridicaStore($request);
        throw new Exception('Codigo invalido: ' . $request->codigo);
    }
}
