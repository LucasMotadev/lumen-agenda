<?php

namespace App\Validate;


trait UserValidate
{

    public function getCreateRules(): array
    {
        return [
            'email' => 'required|unique:users,email',
            'apelido' => 'required',
            'password' =>   'required'
        ];
    }

    public function getUpdateRules($id): array
    {
        return [];
    }

    public function getDestroyRules(): array 
    {
        return [];
    }
}
