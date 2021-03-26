<?php

namespace App\Validate\People;

trait PessoasJuridicasValidate 
{

    public function getCreateRules(): array
    {
        return [
            'pessoa_id' => 'numeric|max:11|required|unique:pessoas_juridicas,pessoa_id|exists:pessoas,id',
            'razao_social' => 'string|max:100|required|',
            'inscricao_estadual' => 'string|max:20|',
            'nome_fantazia' => 'string|max:100|required',
            'status_id' => 'numeric|max:11|required',
        ];
    }

    public function getUpdateRules($id): array
    {
        return [
            'pessoa_id' => 'numeric|max:11|unique:pessoas_juridicas,pessoa_id|exists:pessoas,id',
            'razao_social' => 'string|max:100',
            'inscricao_estadual' => 'string|max:20',
            'nome_fantazia' => 'string|max:100',
            'status_id' => 'numeric|max:11',
        ];
    }
}
