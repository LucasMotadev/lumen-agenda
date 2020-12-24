<?php
namespace App\Policies;

interface IPolicy {
    public function check($value);
}