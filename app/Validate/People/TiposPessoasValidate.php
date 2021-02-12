<?php

namespace App\Validate\People;

use App\Validate\BaseValidate;
use App\Validate\IValidate;

class TiposPessoasValidate extends BaseValidate implements IValidate
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
