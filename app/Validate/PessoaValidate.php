<?php

namespace App\Validate;


class PessoaValidate extends BaseValidate implements IValidate
{

    public function getCreateRules(): array
    {
    
        return [
            'nome' => 'required',
            'codigo' => 'required|min:11|max:14|unique:pessoas',
        ];
    }

    public function getUpdateRules($id): array
    {
        return [
            'codigo' => 'min:11|max:14|unique:pessoas',
        ];
    }
}
