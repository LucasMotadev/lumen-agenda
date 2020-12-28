<?php

namespace App\Policies\User;
use App\Policies\IPolicy;


class UserPolicy implements IPolicy{

    public function update($user, $value):bool
    {
        return true;
    }

    public function index($user, $value):bool
    {
        return true;
    }

    public function show($user, $value):bool
    {
        return true;
    }

    public function destroy($user, $value):bool
    {
        return true;
    }

}