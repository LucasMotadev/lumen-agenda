<?php
        namespace App\Model\Tables;

        use Illuminate\Database\Eloquent\Model;

        class GrupoPermissions extends Model 
        {

            protected $table = "grupo_permissions";
    
            protected $fillabe = ["permission_id","grupo_user_id"];
    
            protected $primaryKey = "primary";

            public function setPrimaryKey()
            { 
                return $this->primaryKey;
            }
    
            
    
            public function permissions()
            {
                return $this->belongsTo("App\Model\Tabels", "permission_id","id");
            }
                          
        public function gruposUsers()
            {
                return $this->belongsTo("App\Model\Tabels", "grupo_user_id","id");
            }
                          
        
                   
        }
        
        