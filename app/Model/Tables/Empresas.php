<?php
        namespace App\Model\Tables;

        use Illuminate\Database\Eloquent\Model;

        class Empresas extends Model 
        {

            protected $table = "empresas";
    
            protected $fillabe = ["id","pessoa_juridica_id","apelido","empresa_matriz_id"];
    
            protected $primaryKey = "primary";

            

            public function setPrimaryKey()
            { 
                return $this->primaryKey;
            }
    
            public function centroCustos()
            {
                return $this->hasMany("App\Models\Tables", "empresa_id","id");
            }
                          
        public function empresas()
            {
                return $this->hasMany("App\Models\Tables", "empresa_matriz_id","id");
            }
                          
        
    
            public function pessoasJuridicas()
            {
                return $this->belongsTo("App\Model\Tabels", "pessoa_juridica_id","id");
            }
                          
        public function empresas()
            {
                return $this->belongsTo("App\Model\Tabels", "empresa_matriz_id","id");
            }
                          
        
                   
        }
        
        