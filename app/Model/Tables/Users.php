<?php
        namespace App\Model\Tables;

        use Illuminate\Database\Eloquent\Model;

        class Users extends Model 
        {

            protected $table = "users";
    
            protected $fillabe = ["id","password","apelido","pessoa_id","token","created_at","updated_at","status_user_id","grupo_user_id","login"];
    
            protected $primaryKey = "primary";

            

            public function setPrimaryKey()
            { 
                return $this->primaryKey;
            }
    
            
    
            public function pessoas()
            {
                return $this->belongsTo("App\Model\Tabels", "pessoa_id","id");
            }
                          
        public function gruposUsers()
            {
                return $this->belongsTo("App\Model\Tabels", "grupo_user_id","id");
            }
                          
        
                   
        }
        
        