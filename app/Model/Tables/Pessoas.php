<?php
        namespace App\Model\Tables;

        use Illuminate\Database\Eloquent\Model;

        class Pessoas extends Model 
        {

            protected $table = "pessoas";
    
            protected $fillabe = ["id","tipo_pessoa_id","created_at","updated_at"];
    
            protected $primaryKey = "id";

            

            public function setPrimaryKey()
            { 
                return $this->primaryKey;
            }
    
            public function pessoasJuridicas()
            {
                return $this->hasMany("App\Models\Tables", "pessoa_id","id");
            }
                          
        public function telefones()
            {
                return $this->hasMany("App\Models\Tables", "pessoa_id","id");
            }
                          
        public function emails()
            {
                return $this->hasMany("App\Models\Tables", "pessoa_id","id");
            }
                          
        public function enderecos()
            {
                return $this->hasMany("App\Models\Tables", "pessoa_id","id");
            }
                          
        public function users()
            {
                return $this->hasMany("App\Models\Tables", "pessoa_id","id");
            }
                          
        public function pessoasFisicas()
            {
                return $this->hasMany("App\Models\Tables", "pessoa_id","id");
            }
                          
        
    
            public function tiposPessoas()
            {
                return $this->belongsTo("App\Model\Tabels", "tipo_pessoa_id","id");
            }
                          
        
                   
        }
        
        