<?php
namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Concerns\ValidatesAttributes;

class Pessoa extends Model {

    protected $fillable = [
        'nome','codigo','pessoas_tipo_id'
    ];


    public function setNomeAttribute($value){

        preg_match('/([^\w\s])/',$value, $nome);
        if(!empty($nome[0])) throw new Exception('O nome não pode conter caracteres especiais: ' . $nome[0] );
        $this->attributes['nome'] = $value;
    }

    public function setCodigoAttribute($value){
     
        $this->validaCodigo($value);
        if(strlen($value) == 11) $this->validaCpf($value);
        if(strlen($value) == 14) $this->validaCnpj($value);

        $this->attributes['codigo'] = $value;
    }

    public function validaCpf($cpf){
          // Extrai somente os números
    $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
     
    // Verifica se foi informado todos os digitos corretamente
    if (strlen($cpf) != 11) {
        return false;
    }

    // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    // Faz o calculo para validar o CPF
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf{$c} * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf{$c} != $d) {
            return false;
        }
    }
    $this->attributes['pessoas_tipo_id'] = 'F';
    return true;


    }
    public function validaCnpj($cnpj){

        $this->attributes['pessoas_tipo_id'] = 'J';
    }

    public function validaCodigo($value){

        $count = strlen(preg_replace('/\D/','',$value));
        if( $count != 14 &&  $count  != 11) throw new Exception('Codigo invalido');

       $codigo =  self::where('codigo',$value)->count();
       if($codigo > 0) throw new Exception("Codigo: $value  já cadastrado!");
    }

}