<?php

require_once("controller/Base.php");
require_once("function/array_combine_key.php");
require_once("function/array_group_value.php");

/**
 * Para cierto periodo se verifica que el plan del alumno coincida con el de la
 * comision
 */
class EstadoCorrectoSinLegajoScript extends BaseController{

    public function main(){
        $anioCalendario = $_REQUEST["anio"];
        $semestreCalendario = $_REQUEST["semestre"];
        $alumnoComision_ = $this->alumnoComision_($anioCalendario, $semestreCalendario);
        $idAlumno_ = array_column($alumnoComision_, "alumno");
        $alumno_ = $this->container->query("alumno")->cond([
            ["id","=",$idAlumno_],
            ["estado_inscripcion",EQUAL,"Correcto"],
            ["tiene_certificado",EQUAL,false],
            ["tiene_constancia",EQUAL,false],
        ])->field("id")->size(0)->column();

        echo "<pre>";
        for($i=0; $i <  count($alumno_); $i++){
            echo "<a href='https://planfines2.com.ar/users4/alumno-admin?id=" . $alumno_[$i] . "'>" . $alumno_[$i] . "</a><br>";
        }
    }

    public function alumnoComision_($anioCalendario, $semestreCalendario){
        return $this->container->query("alumno_comision")
        ->fields()
        ->size(0)
        ->cond([
          ["estado",NONEQUAL,"Mesa"],
          ["calendario-anio","=",$anioCalendario],
          ["calendario-semestre","=",$semestreCalendario],
        ])->all();
    }
}