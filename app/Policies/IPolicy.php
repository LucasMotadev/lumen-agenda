<?php
namespace App\Policies;

interface IPolicy {
    public function update($user, $value):bool;

    public function index($user, $value):bool;

    public function show($user, $value):bool;

    public function destroy($user, $value):bool;

}