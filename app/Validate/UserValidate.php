<?php

namespace App\Validate;


class UserValidate extends BaseValidate implements IValidate
{

    public function getCreateRules(): array
    {
        

        return [
            'email' => 'required|unique:users|' . $this->regexEmail(),
            'apelido' => 'required',
            'password' =>   'required'
        ];
    }

    public function getUpdateRules($id): array
    {
        return [];
    }
}
