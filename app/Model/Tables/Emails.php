<?php
        namespace App\Model\Tables;

        use Illuminate\Database\Eloquent\Model;

        class Emails extends Model 
        {

            protected $table = "emails";
    
            protected $fillabe = ["id","pessoa_id","email","created_at","updated_at"];
    
            protected $primaryKey = "primary";

            public function setPrimaryKey()
            { 
                return $this->primaryKey;
            }
    
            
    
            public function pessoas()
            {
                return $this->belongsTo("App\Model\Tabels", "pessoa_id","id");
            }
                          
        
                   
        }
        
        