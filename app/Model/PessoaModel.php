<?php

namespace App\Model;

use App\Pessoa;
use App\PessoasFisica;
use App\PessoasJuridica;
use Exception;
use Illuminate\Http\Request;


class PessoaModel
{
    private $idPessoa;

    public function pessoaStore(Request $request)
    {
        $pessoa = new Pessoa();
        $pessoa->nome      = $request->nome;
        $pessoa->codigo    = $request->codigo;
        $pessoa->save();
        $this->idPessoa = $pessoa->id;
     
    }
    public function pessoaFisicaStore(Request $request)
    {
        $this->pessoaStore($request);
        $pessoaFisica = new PessoasFisica();
        $pessoaFisica->pessoa_id = $this->idPessoa;
        $pessoaFisica->data_nascimento = $request->data_nascimento;
        $pessoaFisica->rg = $request->rg;
        $pessoaFisica->sexo = $request->sexo;
        $pessoaFisica->save();
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
