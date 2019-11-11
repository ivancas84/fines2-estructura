<?php

/**
 * Script para definir comisiones
 */
require_once("../config/config.php");
require_once("class/model/Data.php");
require_once("class/model/Values.php");
require_once("class/controller/Transaction.php");

require_once("function/array_unique_key.php");
require_once("function/array_combine_keys.php");
require_once("function/array_group_value.php");

$comision = $_GET["comision"];
$dias_ = $_GET["dias"];
$hora_inicio_ = $_GET["hora_inicio"];

$cursos = cursos($comision);
$id_cargas_horarias = array_unique_key($cursos, "carga_horaria"); 
$distribuciones_horarias = distribuciones_horarias($id_cargas_horarias);
$chs_dhs = array_group_value($distribuciones_horarias, "carga_horaria");

$dias = explode(",",$dias_) ;
$hora_inicio = DateTime::createFromFormat('H:i', $hora_inicio_);
$definido = [];
/** 
 * Array multiple donde se definen los dias y las horas ya procesadas 
 * Ejemplo de elemento: ["dia"=>1, "horas_catedra"=>2]
 */
foreach($cursos as $curso){
    if(!key_exists($curso["carga_horaria"], $chs_dhs)) {
        echo "*El curso no posee distribuciones horarias asociadas<br>";
        continue;
    }        
    $dhs = $chs_dhs[$curso["carga_horaria"]];

    foreach($dhs as $dh){
        if(empty($dias[$dh["dia"]-1])) {
            echo "<pre>";
            echo "error al definir día";
            echo "</pre>";
            break;
        }


        $hora_inicio_ = clone $hora_inicio;
        foreach($definido as $def){            
            if($def["dia"] == $dh["dia"]) {                    
                $minutos = $def["horas_catedra"] * 40; 
                $hora_inicio_->add(new DateInterval('PT' . $minutos . 'M'));                
            }
        }
    
        array_push($definido, ["dia" => $dh["dia"], "horas_catedra" => $dh["horas_catedra"]]);
        $hora_fin = clone $hora_inicio_;
        $minutos = $dh["horas_catedra"] * 40; 
        $hora_fin->add(new DateInterval('PT' . $minutos . 'M'));                

        $horario = new HorarioValues;
        $horario->horaInicio = $hora_inicio_;
        $horario->horaFin = $hora_fin;
        $horario->curso = $curso["id"];
        $horario->dia = $dias[$dh["dia"]-1];
        
        $persist = HorarioSqlo::getInstance()->insert($horario->toArray());
        echo $persist["sql"];
    }
        
}

   


echo "* definir dias por comision: ";
$horario = ["hora_inicio" => "17:00", "dias" => [1,3,5]]; 


echo "* consultar distribuciones horarias: ";
$distribuciones_horarias = distribuciones_horarias($id_cargas_horarias);
echo count($distribuciones_horarias) . " registros<br>";

echo "* agrupar distribuciones horarias por carga horaria: ";
$chs_dhs = array_group_value($distribuciones_horarias, "carga_horaria");
echo count($chs_dhs) . " registros<br>";



foreach($comisiones_cursos as $idc => $cursos){

    if(!tiene_dias($idc, $comision_dias, $cursos[$idc])) continue;
    
    
   
    $dias = $comision_dias[$idc]["dias"];
    $hora_inicio = $comision_dias[$idc]["hora_inicio"];
    $definido = [];
    /** 
     * Array multiple donde se definen los dias y las horas ya procesadas 
     * Ejemplo de elemento: ["dia"=>1, "horas_catedra"=>2]
     */
    foreach($cursos as $curso){
        if(!key_exists($curso["carga_horaria"], $chs_dhs)) {
            echo "*El curso no posee distribuciones horarias asociadas<br>";
            continue;
        }        
        $dhs = $chs_dhs[$curso["carga_horaria"]];
        echo "<pre>";

        foreach($dhs as $dh){
            if(empty($dias[$dh["dia"]-1])) {
                echo "<pre>";
                echo "error al definir día";
                print_r($comision_dias[$idc]);
                echo $dh["dia"]-1;
                print_r($curso);

                echo "</pre>";
                break;
            }


            $hora_inicio_ = clone $hora_inicio;
            foreach($definido as $def){            
                if($def["dia"] == $dh["dia"]) {                    
                    $minutos = $def["horas_catedra"] * 40; 
                    $hora_inicio_->add(new DateInterval('PT' . $minutos . 'M'));                
                }
            }
    
            array_push($definido, ["dia" => $dh["dia"], "horas_catedra" => $dh["horas_catedra"]]);
            $hora_fin = clone $hora_inicio_;
            $minutos = $dh["horas_catedra"] * 40; 
            $hora_fin->add(new DateInterval('PT' . $minutos . 'M'));                

            $horario = new HorarioValues;
            $horario->horaInicio = $hora_inicio_;
            $horario->horaFin = $hora_fin;
            $horario->curso = $curso["id"];
            $horario->dia = $dias[$dh["dia"]-1];
            
            $persist = HorarioSqlo::getInstance()->insert($horario->toArray());
            echo $persist["sql"];
        }
        
    }

}