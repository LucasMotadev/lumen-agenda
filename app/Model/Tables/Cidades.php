<?php
        namespace App\Model\Tables;

        use Illuminate\Database\Eloquent\Model;

        class Cidades extends Model 
        {

            protected $table = "cidades";
    
            protected $fillabe = ["id","estado_id","cep"];
    
            protected $primaryKey = "primary";

            

            public function setPrimaryKey()
            { 
                return $this->primaryKey;
            }
    
            public function ruas()
            {
                return $this->hasMany("App\Models\Tables", "cidade_id","id");
            }
                          
        
    
            public function estados()
            {
                return $this->belongsTo("App\Model\Tabels", "estado_id","id");
            }
                          
        
                   
        }
        
        