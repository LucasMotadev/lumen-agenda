<?php

namespace App\Policies;

use Illuminate\Database\Eloquent\Model;

class PessoaPolicy extends BasePolicy implements IPolicy
{
    public function __construct()
    {
        parent::__construct(PessoaPolicy::class);
    }

    public function update(Model $pessoa): bool
    {
        return $this->auth->id == $pessoa->id;
    }

    public function index($user, $pessoa): bool
    {
        return true;
    }

    public function show($user, $pessoa): bool
    {
        return true;
    }

    public function destroy($user, $value): bool
    {
        return true;
    }
}
