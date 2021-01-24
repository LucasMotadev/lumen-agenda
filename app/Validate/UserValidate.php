<?php

namespace App\Validate;


class UserValidate extends BaseValidate implements IValidate
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
}
