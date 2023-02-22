<?php

require_once("controller/base.php");

/**
 * Buscar alumnos repetidos para un periodo (año y semestre)      
 */
class AlumnosRepetidosPeriodoScript extends BaseController{

    public function main(){
        echo "<pre>";

        $anioCalendario = $_REQUEST["anio"];
        $semestreCalendario = $_REQUEST["semestre"];
        $alumnoComision_ = $this->alumnoComision_($anioCalendario, $semestreCalendario);
        print_r($alumnoComision_);  
    }

    public function alumnoComision_($anioCalendario, $semestreCalendario){
        return $this->container->query("alumno_comision")
        ->fields(["comision.count"])
        ->group(["persona-numero_documento"])
        ->size(0)
        ->having(["comision.count",GREATER,"1"])
        ->cond([
          ["estado",NONEQUAL,"Mesa"],
          ["calendario-anio","=",$anioCalendario],
          ["calendario-semestre","=",$semestreCalendario],
        ])->all();
        die();
    }
}