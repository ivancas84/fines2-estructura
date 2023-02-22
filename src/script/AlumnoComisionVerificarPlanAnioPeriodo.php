<?php

require_once("controller/base.php");
require_once("function/array_combine_key.php");
require_once("function/array_group_value.php");

/**
 * Para cierto periodo se verifica que el plan del alumno coincida con el de la
 * comision
 */
class AlumnoComisionVerificarPlanAnioPeriodoScript extends BaseController{

    public function main(){
        $anioCalendario = $_REQUEST["anio"];
        $semestreCalendario = $_REQUEST["semestre"];
        $alumnoComision_ = $this->alumnoComision_($anioCalendario, $semestreCalendario);
        if(empty($alumnoComision_)) {
            echo "No existen alumnos en el periodo";
            return;
        }
        $response = [
            "anio"=>[],
            "plan"=>[]
        ]; 
        for($i =0; $i < count($alumnoComision_); $i++){
            if($alumnoComision_[$i]["plan-id"] != $alumnoComision_[$i]["plan_alu-id"])
                array_push($response["plan"], $alumnoComision_[$i]["alumno-id"]); 
            if(intval($alumnoComision_[$i]["planificacion-anio"]) < intval($alumnoComision_[$i]["alumno-anio_ingreso"]))
                array_push($response["anio"], $alumnoComision_[$i]["alumno-id"]); 
        }
        if(empty($response["plan"])) echo "No existen alumnos con el plan diferente";
        if(empty($response["anio"])) echo "No existen alumnos con el año diferente";

        else print_r($response);
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