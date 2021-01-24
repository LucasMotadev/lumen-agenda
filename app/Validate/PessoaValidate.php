<?php

namespace App\Validate;


class PessoaValidate extends BaseValidate implements IValidate
{

    public function getCreateRules(): array
    {
    
        return [
            'tipo_pessoa_id' => 'required|exists:tipos_pessoas,id',
            'codigo' => 'required|unique:pessoas,codigo|min:11|max:14'
        ];
    }

    public function getUpdateRules($id): array
    {
        return [
            'tipo_pessoa_id' => 'required|exists:tipos_pessoas:id',
            'codigo' => 'required|unique:pessoas,codigo|min:11|max:14'
        ];
    }
}
