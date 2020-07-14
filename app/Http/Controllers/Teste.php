<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Diff\Diff;

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
    public function horariosDisponiveis2(){
      try {
          echo '<pre>';
      
              $table = DB::select("SELECT
              *
              FROM agendamento 
              where 1=1
              
              order by data_inicio
             
              ");
           
           

            $intervalos =[];
            $i = 0;

            $tempoServico ='00:30:00';
            foreach ($table as  $value) {

              if(isset($table[$i + 1])){
                
                 
                $inicio_horario_disponivel = $table[$i]->data_fim;
                $fim_horario_disponivel = date('H:i:s', strtotime($table[$i + 1]->data_inicio));
                $horario_termino = '';                                                           // tempo de serviço
                while ( $horario_termino  < $fim_horario_disponivel ) {

                  $horario_termino  =  date('H:i:s', strtotime($inicio_horario_disponivel) + strtotime($tempoServico));
                  echo 'Horaio_para_termino : ' .$horiro_para_termino . "<br>";
            
                  array_push($intervalos, [
                    'tempo_livre'             => date("H:i:s", strtotime($table[$i + 1]->data_inicio)  - strtotime($table[$i]->data_fim)),
                    'horario_inicio_livre'    => $table[$i]->data_fim,
                    'horario_fim_livre'       => $table[$i + 1]->data_inicio,
                    'h_disponiveis_inicio'    => $horiro_para_inicio,
                    'h_disponiveis_termino'   => $horiro_para_termino

                  ] );

                  $horiro_para_inicio = $horiro_para_termino;
              
                }
      
              }
               $i++;
            }

         
             print_r($intervalos);
       
      
     //  echo   date("H:i:s", strtotime("2020-07-13 00:01:00") + strtotime('00:01:00'));

      } catch (\Exception $e) {
          echo $e->getMessage();
      }

  }
}
