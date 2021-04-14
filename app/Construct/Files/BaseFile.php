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
                continue;
            }

            $newName .= ucfirst($value);
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
        preg_match('/app.*(?=\\\\)/i', $path, $nameSpace);
        return ucfirst(str_replace('/', '\\', $nameSpace[0]));
    }

    public function dirExiste($filename)
    {
        $pathInfo = pathinfo($filename);

        if (file_exists($pathInfo['dirname']))  return;
        $result =  mkdir($pathInfo['dirname']);
        if (!$result) throw new Exception('Erro ao criar diretorio');
        
    }

    public function createFile(string $filename, string $class)
    {
        $this->dirExiste($filename);
        $arquivo = fopen($filename, 'w');
        if (!$arquivo) throw new \Exception("Erro ao criar Class  {$this->snakeCaseToPascalCase($filename)}");
        fwrite($arquivo, $class);
        fclose($arquivo);

        return $filename;
    }

    public function create()
    {
        $this->createFile($this->stringClass['filename'], $this->stringClass['class']);
    }

    public function get(): array
    {
        return $this->stringClass;
    }
}
