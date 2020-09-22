<?php
        namespace App\Model\Tables;

        use Illuminate\Database\Eloquent\Model;

        class PessoasFisicas extends Model 
        {

            protected $table = "pessoas_fisicas";
    
            protected $fillabe = ["id","cpf","rg","nome","sexo","created_at","updated_at","pessoa_id"];
    
            protected $primaryKey = "primary";

            public function setPrimaryKey()
            { 
                return $this->primaryKey;
            }
    
            public function colaboradores()
            {
                return $this->hasMany("App\Models\Tables", "pessoa_fisica_id","id");
            }
                          
        
    
            public function pessoas()
            {
                return $this->belongsTo("App\Model\Tabels", "pessoa_id","id");
            }
                          
        
                   
        }
        
        