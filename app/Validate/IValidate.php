<?php

namespace App\Validate;

interface IValidate
{
    public function getCreateRules(): array;
    public function getUpdateRules($id): array;
    public function getDestroyRules(): array;
}
