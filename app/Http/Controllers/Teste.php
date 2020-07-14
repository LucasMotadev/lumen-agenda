<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class Teste extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function horariosDisponiveis(){

        try {
            $table = DB::select('SELECT 
            horario horario_para_inicio,
            ADDTIME(horario,"00:30:00") horairo_para_termino
            FROM
            teste.horarios
    
            ');
    
            echo '<pre>';
       
            $arrHd = [];
            foreach ($table as $value) {
                $table = DB::select("SELECT
                *
                FROM agendamento 
                where 1=1
                and '2020-07-13 $value->horario_para_inicio'    between data_inicio and data_fim
                or  '2020-07-13 $value->horairo_para_termino'   between data_inicio and data_fim
                or  '2020-07-13 $value->horairo_para_termino'   between '2020-07-13 17:00:00' and '2020-07-14 07:59:00'
                or  '2020-07-13 $value->horario_para_inicio '   between '2020-07-13 17:00:00' and '2020-07-14 07:59:00'
            
                ");
             

                if(empty($table)){
                    array_push($arrHd, [ 
                        'inicio'  => $value->horario_para_inicio,
                        'termino' => $value->horairo_para_termino
                     ]);
                } 
              
            }

            print_r($arrHd);
            //code...
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

    }
}
