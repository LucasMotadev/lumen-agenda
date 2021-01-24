<?php
namespace App\Construct\Created;

use Exception;

class BaseCreate{
    
    public function createFile($filename, $data)
    {
        if (file_exists($filename)) throw new Exception("Erro ao criar Class  {$this->Model->classToCamelcase($filename)}, o arquivo já existe");
        $arquivo = fopen($filename, 'w');
        if (!$arquivo) throw new Exception("Erro ao criar Class  {$this->Model->classToCamelcase($filename)}");
        fwrite($arquivo, $data);
        //Fechamos o arquivo após escrever nele
        fclose($arquivo);

        return $filename;
    } 
}