<?php

namespace App\Construct\Files;

abstract class BaseFile 
{
    #snake_case to camelCase
    public function snakeCaseToCamelcase($name)
    {

        $arrName = explode('_', strtolower($name));
        $newName = '';
        foreach ($arrName as $key => $value) {

            if ($key === 0) {
                $newName = $value;
            } else {

                $newName .= ucfirst($value);
            }
        }

        return $newName;
    }

    public function snakeCaseToPascalCase($name)
    {
      return ucfirst($this->snakeCaseToCamelcase($name));
    }

    public function filePathToNamesape(string $path){
        return ucfirst(str_replace('/','\\',$path));
    }


    public function createFile(string $filename, string $class)
    {
        if (file_exists($filename)) throw new \Exception("Erro ao criar Class  {$this->snakeCaseToPascalCase($filename)}, o arquivo já existe");
        $arquivo = fopen($filename, 'w');
        if (!$arquivo) throw new \Exception("Erro ao criar Class  {$this->snakeCaseToPascalCase($filename)}");
        fwrite($arquivo, $class);
        //Fechamos o arquivo após escrever nele
        fclose($arquivo);

        return $filename;
    } 

    public function create()
    {
        foreach ($this->arrStringClass as $filename => $stringClass) {
            $this->createFile($filename, $stringClass);
        }
    }

    public function get()
    {
        return $this->arrStringClass;
    }
}
