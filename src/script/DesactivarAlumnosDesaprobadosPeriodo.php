<?php

require_once("controller/Base.php");
require_once("function/array_combine_key.php");
require_once("function/array_group_value.php");

/**
 * Si el alumno no aprobo 3 materias o mas se cambia el estado a No Activo
 * No se recomienda ejecutar el script con alumnos duplicados en las mismas comisiones del periodoPara este punto no debe haber alumnos duplicados.
 * Solo se evaluan las asignaturas de la comision
 * Limitaciones:
 *      - Si el alumno no esta en condiciones de cursar porque arrastra materias
 *      desaprobadas de semestres anteriores.
 *      - Si las evaluaciones corresponden a docentes de la comision que se esta 
 *      evaluando
 *       
 */
class DesactivarAlumnosDesaprobadosPeriodoScript extends BaseController{

    public function main(){
        $anioCalendario = $_REQUEST["anio"];
        $semestreCalendario = $_REQUEST["semestre"];
        $alumnoComision_ = $this->alumnoComision_($anioCalendario, $semestreCalendario);
        if(empty($alumnoComision_)) {
            echo "No existen alumnos en el periodo";
            die();
        } 
        $alumnoComision_ = array_group_value($alumnoComision_, "comision");
        $response = [
            "alumno_comision_desactivar" => [],
            "alumno_desactivar" => [],
            "alumno_comision_activar" => [],
            "alumno_activar" => []
        ];
        foreach($alumnoComision_ as $comision => $aluCom_){
            $aluComAux_ = array_combine_key($aluCom_,"alumno");
            $idAlumnoAC_ = array_keys($aluComAux_);
            $cantidadCalificacionAlumno_ = $this->container->controller_("model_tools")->cantidadCalificacionesAprobadasPlanificacion_(
                array_keys($aluComAux_),
                $aluCom_[0]["planificacion-id"] 
            );
            $idAlumnoC_ = array_column($cantidadCalificacionAlumno_,"alumno");
            $idAlumnoSinCalificaciones_ = array_diff($idAlumnoAC_, $idAlumnoC_); 

            foreach($idAlumnoSinCalificaciones_ as $idAlumno){
                if($aluComAux_[$idAlumno]["estado"] == "No activo") continue;
                array_push($response["alumno_comision_desactivar"],$aluComAux_[$idAlumno]["id"]);
                array_push($response["alumno_desactivar"],$idAlumno);
            }

            for($i = 0; $i < count($cantidadCalificacionAlumno_); $i++){
                $idAlumno = $cantidadCalificacionAlumno_[$i]["alumno"];
                if(intval($cantidadCalificacionAlumno_[$i]["cantidad"]) < 3){
                    if($aluComAux_[$idAlumno]["estado"] =="Activo") {
                        array_push($response["alumno_comision_desactivar"],$aluComAux_[$idAlumno]["id"]);
                        array_push($response["alumno_desactivar"],$idAlumno);
                    }
                } elseif($aluComAux_[$idAlumno]["estado"] == "No activo") {
                    array_push($response["alumno_comision_activar"],$aluComAux_[$idAlumno]["id"]);
                    array_push($response["alumno_activar"],$idAlumno);
                }
            }    
        }

        echo "<pre>";
        print_r($response);
        // print_r(implode("', '", $response["alumno_comision_desactivar"]));        
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