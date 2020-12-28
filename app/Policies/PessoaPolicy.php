<?php

namespace App\Policies;



class PessoaPolicy implements IPolicy
{
    public function update($user, $pessoa):bool
    {
        return $user->id == $pessoa->id;
        
    }

    public function index($user , $pessoa):bool
    {
        return true;
    }

    public function show($user, $pessoa):bool
    {
        return true;
    }

    public function destroy($user, $value):bool
    {
        return true;
    }
}
