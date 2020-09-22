<?php
        namespace App\Model\Tables;

        use Illuminate\Database\Eloquent\Model;

        class Colaboradores extends Model 
        {

            protected $table = "colaboradores";
    
            protected $fillabe = ["id","pessoa_fisica_id","centro_custo_id","funcao_id"];
    
            protected $primaryKey = "primary";

            public function setPrimaryKey()
            { 
                return $this->primaryKey;
            }
    
            
    
            public function pessoasFisicas()
            {
                return $this->belongsTo("App\Model\Tabels", "pessoa_fisica_id","id");
            }
                          
        public function funcao()
            {
                return $this->belongsTo("App\Model\Tabels", "funcao_id","id");
            }
                          
        
                   
        }
        
        