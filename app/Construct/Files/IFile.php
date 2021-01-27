<?php

namespace App\Construct\Files;

interface IFIle {
    public function getClass():string;
    public function createClass(array $modelFile, string $nameSpace);
    
}