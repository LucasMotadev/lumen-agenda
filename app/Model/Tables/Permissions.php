<?php
        namespace App\Model\Tables;

        use Illuminate\Database\Eloquent\Model;

        class Permissions extends Model 
        {

            protected $table = "permissions";
    
            protected $fillabe = ["id","descricao","tipo","permission_pai_id"];
    
            protected $primaryKey = "id";

            

            public function setPrimaryKey()
            { 
                return $this->primaryKey;
            }
    
            public function grupoPermissions()
            {
                return $this->hasMany("App\Models\Tables", "permission_id","id");
            }
                          
        public function permissions()
            {
                return $this->hasMany("App\Models\Tables", "permission_pai_id","id");
            }
                          
        
    
            public function permissions()
            {
                return $this->belongsTo("App\Model\Tabels", "permission_pai_id","id");
            }
                          
        
                   
        }
        
        