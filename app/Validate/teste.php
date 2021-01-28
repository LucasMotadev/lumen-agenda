<?php

namespace App\Validate\Company;

use App\Validate\BaseValidate;
use App\Validate\IValidate;

class Empresas extends BaseValidate implements IValidate
{
    public function getCreateRules(): array
    {
        return [
            'id' => 'unique:empresas,id',
            'pessoa_juridica_id' => 'numeric|max:11|required|unique:empresas,pessoa_juridica_id|exists:pessoas_juridicas,id',
            'apelido' => 'string|max:5|required|unique:empresas,apelido',
            'created_at' => 'date_format:Y-m-d H:i:s|',
            'updated_at' => 'date_format:Y-m-d H:i:s|',
            'bandeira_id' => 'numeric|max:11|required|exists:bandeira,id'
        ];
    }
    public function getUpdateRules($id): array
    {
        return [
            'id' => 'unique:empresas,id',
            'pessoa_juridica_id' => 'numeric|max:11|unique:empresas,pessoa_juridica_id|exists:pessoas_juridicas,id',
            'apelido' => 'string|max:5|unique:empresas,apelido',
            'created_at' => 'date_format:Y-m-d H:i:s|',
            'updated_at' => 'date_format:Y-m-d H:i:s|',
            'bandeira_id' => 'numeric|max:11|exists:bandeira,id'
        ];
    }
}
