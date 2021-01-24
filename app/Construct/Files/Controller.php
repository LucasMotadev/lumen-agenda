<?php

namespace App\Construct\Files;


use Illuminate\Http\Client\Request;

class Controller extends BaseFile {

    private  $baseController;
    private  $nameController;
    private  $useModel;
    private  $useValidate;


    public function getClass(string $model = null)
    {
        return "
        <?php

        namespace App\Http\Controllers;
        use App\Http\Controllers\BaseController;
        use Illuminate\Http\Request;

        use {$this->useModel};
        use {$this->useValidate};

        class {$this->nameController} extends BaseController {

        public function __construct(Request ".'$request'.")
        {
            parent::__construct(".'$request'.", new {$this->model}(), new {$this->validate}());
        }
        
        }
        ";
    }

    public function setNamespace($name):void
    {
        $this->namespace = $name;
    }

    public function setModel($model): void
    {
        $this->model = $model;
    }

    public function setValidate($validate): void
    {
        $this->validate = $validate;
    }

    
    
}