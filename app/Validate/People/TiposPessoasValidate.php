<?php

namespace App\Validate\People;


trait TiposPessoasValidate 
{

    public function getCreateRules(): array
    {
        return [
            'id' => 'unique:tipos_pessoas,id',
            'descricao' => 'string|max:45|required'
        ];
    }

    public function getUpdateRules($id): array
    {
        return [
            'id' => 'unique:tipos_pessoas,id',
            'descricao' => 'unique:tipos_pessoas,descricao|string|max:45'
        ];
    }
}
