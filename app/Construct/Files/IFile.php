<?php

namespace App\Construct\Files;

interface IFIle {
    public function buildTemplate():string;
    public function writeClass();
    public function getArrStringClass(): array;
    
}