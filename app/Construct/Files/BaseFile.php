<?php

namespace App\Construct\Files;

use Exception;

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

    public function snakeCaseToKebabCase($name)
    {
        return str_replace('_', '-', $name);
    }

    public function filePathToNamesape(string $path)
    {
        return ucfirst(str_replace('/', '\\', $path));
    }

    #caso o path nao exista ele é criado
    public function fileExists($filename): void
    {
        $pathInfo = pathinfo($filename);
        if (!file_exists($pathInfo['dirname'])) {
            $result =  mkdir($pathInfo['dirname']);
            if (!$result) throw new Exception('Erro ao criar diretorio');
        }

        if (file_exists($filename)) throw new \Exception("Erro ao criar Class  {$this->snakeCaseToPascalCase($filename)}, o arquivo já existe");
    }

    public function createFile(string $filename, string $class)
    {
        $this->fileExists($filename);
        $arquivo = fopen($filename, 'w');
        if (!$arquivo) throw new \Exception("Erro ao criar Class  {$this->snakeCaseToPascalCase($filename)}");
        fwrite($arquivo, $class);
        //Fechamos o arquivo após escrever nele
        fclose($arquivo);

        return $filename;
    }

    public function create()
    {
        $this->createFile($this->stringClass['filename'], $this->stringClass['class']);
    }

    public function get():array
    {
        return $this->stringClass;
    }
}
