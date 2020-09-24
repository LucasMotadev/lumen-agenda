<?php
        namespace App\Model\Tables;

        use Illuminate\Database\Eloquent\Model;

        class Ruas extends Model 
        {

            protected $table = "ruas";
    
            protected $fillabe = ["id","nome","cep","cidade_id"];
    
            protected $primaryKey = "primary";

            

            public function setPrimaryKey()
            { 
                return $this->primaryKey;
            }
    
            public function enderecos()
            {
                return $this->hasMany("App\Models\Tables", "rua_id","id");
            }
                          
        
    
            public function cidades()
            {
                return $this->belongsTo("App\Model\Tabels", "cidade_id","id");
            }
                          
        
                   
        }
        
        