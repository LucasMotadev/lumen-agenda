<?php

namespace App\Validate\People;

trait PessoaValidate 
{

    public function getCreateRules(): array
    {
        return [
            'codigo' => 'numeric|unique:pessoas,codigo',
        ];
    }

    public function getUpdateRules($id): array
    {
        return [
            'descricao' => 'unique:tipos_pessoas,descricao|string|max:45'
        ];
    }

    public function getDestroyRules(): array
    {
        return [
            'id' => 'delete_foreign:pessoas_fisicas,pessoa_id,pessoas_juridicas,pessoa_id'          
        ];
    }

}
