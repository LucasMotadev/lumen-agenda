<?php
        namespace App\Model\Tables;

        use Illuminate\Database\Eloquent\Model;

        class Enderecos extends Model 
        {

            protected $table = "enderecos";
    
            protected $fillabe = ["id","numero","complemento","created_at","updated_at","rua_id","pessoa_id"];
    
            protected $primaryKey = "primary";

            public function setPrimaryKey()
            { 
                return $this->primaryKey;
            }
    
            
    
            public function ruas()
            {
                return $this->belongsTo("App\Model\Tabels", "rua_id","id");
            }
                          
        public function pessoas()
            {
                return $this->belongsTo("App\Model\Tabels", "pessoa_id","id");
            }
                          
        
                   
        }
        
        