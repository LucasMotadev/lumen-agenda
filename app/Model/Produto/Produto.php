<?php

/*
|--------------------------------------------------------------------------
| Gerado altomaticamente por engenharia reversa by @Lucas Mota
|--------------------------------------------------------------------------
|
*/

namespace App\Model\Produto;

use App\Model\BaseModel;

class Produtos extends BaseModel
{

    protected $table = "produtos";

    protected $fillable = ['id','descricao','marca_id','produto_categoria_id','valor_custo','valor_venda','created_at','updated_at','data_validate','qt_min','qt_max','cod_barra'];

    protected $primaryKey = "id";

    public $timestamps = false;
        
    public function marcas()
    {
        return $this->hasMany(Marcas::class, 'id', 'marca_id');
    }
    
    public function produtosCategorias()
    {
        return $this->hasMany(ProdutosCategorias::class, 'id', 'produto_categoria_id');
    }
    
    public function agendaServicos()
    {
        return $this->belongsTo(AgendaServicos::class, 'produto_id', 'id');
    }
}

