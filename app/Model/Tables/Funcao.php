<?php
        namespace App\Model\Tables;

        use Illuminate\Database\Eloquent\Model;

        class Funcao extends Model 
        {

            protected $table = "funcao";
    
            protected $fillabe = ["id","descricao","created_at","updated_at"];
    
            protected $primaryKey = "primary";

            public function setPrimaryKey()
            { 
                return $this->primaryKey;
            }
    
            public function colaboradores()
            {
                return $this->hasMany("App\Models\Tables", "funcao_id","id");
            }
                          
        
    
            
                   
        }
        
        