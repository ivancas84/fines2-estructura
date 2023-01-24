<?php

require_once("controller/Base.php");

/**
 * Si el alumno no aprobo 3 materias o mas se cambia el estado a No Activo
 * Solo se evaluan las asignaturas de la comision
 * Limitaciones:
 *      - Si el alumno no esta en condiciones de cursar porque arrastra materias
 *      desaprobadas de semestres anteriores.
 *      - Si las evaluaciones corresponden a docentes de la comision que se esta 
 *      evaluando
 *       
 */
class DesactivarAlumnosDesaprobadosComisionScript extends BaseController{

    public function main(){
        $idComision = $_REQUEST["comision"];
        $alumnoComision_ = $this->alumnoComision_($idComision);
        $idAlumno_ = array_unique(array_column($alumnoComision_, "alumno"));
        $calificacion_ = $this->container->controller_("model_tools")->cantidadCalificacionesAprobadasPlanificacion_($idAlumno_, $alumnoComision_[0]["planificacion-id"] );
        echo "<pre>";

        print_r($calificacion_);
    }

    public function alumnoComision_($idComision){
        return $this->container->query("alumno_comision")
        ->fields()
        ->size(0)
        ->cond([
          ["estado",NONEQUAL,"Mesa"],
          ["comision","=",$idComision],
        ])
        ->order([
          "activo"=>"DESC",
          "persona-apellidos"=>"ASC",
          "persona-nombres"=>"ASC",
        ])->all();
    }
}