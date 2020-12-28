<?php

namespace App\Policies;

use Illuminate\Database\Eloquent\Model;

interface IPolicy
{

    public function update(Model $value): bool;

    public function index($request, $value): bool;

    public function show($user, $value): bool;

    public function destroy($user, $value): bool;
}
