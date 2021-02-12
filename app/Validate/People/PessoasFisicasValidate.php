<?php

namespace App\Validate\People;

use App\Validate\BaseValidate;
use App\Validate\IValidate;

class PessoasFisicasValidate extends BaseValidate implements IValidate
{

    public function getCreateRules(): array
    {
        return [
            'rg' => 'string|max:11',
            'nome' => 'string|max:100',
            'sexo' => 'string|in:M,F,O',
            'pessoa_id' => 'numeric|max:11|required|unique:pessoas_fisicas,pessoa_id|exists:pessoas,id'
        ];
    }

    public function getUpdateRules($id): array
    {
        return [
            'rg' => 'string|max:11',
            'nome' => 'string|max:100',
            'sexo' => 'string|max:1',
            'pessoa_id' => "numeric|max:11|unique:pessoas_fisicas,pessoa_id,$id = pessoas_id|exists:pessoas,id"
        ];
    }
}
