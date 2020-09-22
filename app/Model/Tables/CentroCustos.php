<?php
        namespace App\Model\Tables;

        use Illuminate\Database\Eloquent\Model;

        class CentroCustos extends Model 
        {

            protected $table = "centro_custos";
    
            protected $fillabe = ["id","descricao","empresa_id","centro_custo_pai_id"];
    
            protected $primaryKey = "primary";

            public function setPrimaryKey()
            { 
                return $this->primaryKey;
            }
    
            public function centroCustos()
            {
                return $this->hasMany("App\Models\Tables", "centro_custo_pai_id","id");
            }
                          
        
    
            public function empresas()
            {
                return $this->belongsTo("App\Model\Tabels", "empresa_id","id");
            }
                          
        public function centroCustos()
            {
                return $this->belongsTo("App\Model\Tabels", "centro_custo_pai_id","id");
            }
                          
        
                   
        }
        
        