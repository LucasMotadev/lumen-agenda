<?php
        namespace App\Model\Tables;

        use Illuminate\Database\Eloquent\Model;

        class GruposUsers extends Model 
        {

            protected $table = "grupos_users";
    
            protected $fillabe = ["id","descricao"];
    
            protected $primaryKey = "id";

            

            public function setPrimaryKey()
            { 
                return $this->primaryKey;
            }
    
            public function grupoPermissions()
            {
                return $this->hasMany("App\Models\Tables", "grupo_user_id","id");
            }
                          
        public function users()
            {
                return $this->hasMany("App\Models\Tables", "grupo_user_id","id");
            }
                          
        
    
            
                   
        }
        
        