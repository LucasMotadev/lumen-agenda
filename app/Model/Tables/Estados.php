<?php
        namespace App\Model\Tables;

        use Illuminate\Database\Eloquent\Model;

        class Estados extends Model 
        {

            protected $table = "estados";
    
            protected $fillabe = ["id","descricao"];
    
            protected $primaryKey = "primary";

            

            public function setPrimaryKey()
            { 
                return $this->primaryKey;
            }
    
            public function cidades()
            {
                return $this->hasMany("App\Models\Tables", "estado_id","id");
            }
                          
        
    
            
                   
        }
        
        