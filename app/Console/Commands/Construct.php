<?php

namespace App\Console\Commands;

use App\Construct\Orm\Orm;
use Illuminate\Console\Command;

class Construct extends Command
{

    protected $signature = 'construct:model {table} {filename}';
    protected $description = 'created files :model , :validate, :router';

    protected $table;
    protected $filename;
    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        $this->filename = base_path('app\\Model\\'. $this->argument('filename') . '.php');
        if(file_exists($this->filename)) $this->confirmReplaceFile();
        
        $this->model();
    }

    public function confirmReplaceFile(){
        if ($this->confirm("File exist: {$this->filename}, confirm replace ?")) {
            return ;
        }
        $this->info('abort');
        exit;
    }

    public function model(){
        $orm = new Orm($this->argument('table'));
        $orm->mysql()->getClassModel($this->filename);
    }
}
