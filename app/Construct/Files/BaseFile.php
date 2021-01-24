<?php

namespace App\Construct\Files;

class BaseFile 
{

    public function methodToCamelcase($name)
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

    public function classToCamelcase($name)
    {
  
      $arrName = explode('_', strtolower($name));
      $newName = '';
  
      foreach ($arrName as  $value) {
        $newName .= ucfirst($value);
      }
  
      return $newName;
    }

    public function filePathToNamesape(string $path){
        return ucfirst(str_replace('/','\\',$path));
    }

    public function createFile(string $filename, string $class)
    {
        if (file_exists($filename)) throw new \Exception("Erro ao criar Class  {$this->classToCamelcase($filename)}, o arquivo já existe");
        $arquivo = fopen($filename, 'w');
        if (!$arquivo) throw new \Exception("Erro ao criar Class  {$this->classToCamelcase($filename)}");
        fwrite($arquivo, $class);
        //Fechamos o arquivo após escrever nele
        fclose($arquivo);

        return $filename;
    } 
}
