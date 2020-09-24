<?php
        namespace App\Model\Tables;

        use Illuminate\Database\Eloquent\Model;

        class Telefones extends Model 
        {

            protected $table = "telefones";
    
            protected $fillabe = ["id","pessoa_id","ddd","numero","created_at","updated_at"];
    
            protected $primaryKey = "id";

            

            public function setPrimaryKey()
            { 
                return $this->primaryKey;
            }
    
            
    
            public function pessoas()
            {
                return $this->belongsTo("App\Model\Tabels", "pessoa_id","id");
            }
                          
        
                   
        }
        
        