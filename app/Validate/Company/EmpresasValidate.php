<?php

namespace App\Validate\Company;

use App\Validate\BaseValidate;
use App\Validate\IValidate;

trait EmpresasValidate 
{

    public function getCreateRules(): array
    {
        return [
            'id' => 'unique:empresas,id',
            'pessoa_juridica_id' => 'numeric|max:11|required|unique:empresas,pessoa_juridica_id|exists:pessoas_juridicas,id', 
            'apelido' => 'string|max:5|required|unique:empresas,apelido',  
            'bandeira_id' => 'numeric|max:11|required|exists:bandeira,id'
        ];
    }

    public function getUpdateRules($id): array
    {
        return [
            'id' => 'unique:empresas,id', 
            'pessoa_juridica_id' => 'numeric|max:11|unique:empresas,pessoa_juridica_id|exists:pessoas_juridicas,id', 
            'apelido' => 'string|max:5|unique:empresas,apelido', 
            'bandeira_id' => 'numeric|max:11|exists:bandeira,id'
        ];
    }

    public function getDestroyRules(): array
    {
        return [];
    }
}
