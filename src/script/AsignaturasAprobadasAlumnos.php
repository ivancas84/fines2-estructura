<?php

/**
 * CONSIDERACIONES
 * no se procesaran las personas sin dni ya que no puede asignarse la trayectoria
 * si existe mas de una inscripcion por alumno solo se procesara la primera, ignorando la segunda
 * si se vuelve a cargar el mismo archivo (respetando los parámetros), se actualizaran los datos. Con esto se da la posibilidad de correjir los errores en el csv y volverlo a cargar.
 */
set_time_limit(0);  
require_once("controller/base.php");
require_once("function/settypebool.php");
require_once("function/array_group_value.php");


class AsignaturasAprobadasAlumnosScript extends BaseController {

  function main() {
    $idComision = $_REQUEST["comision"];
    $alumnoComision_ = $this->alumnoComision_($idComision);

    $idAlumno_ = array_unique(
      array_column($alumnoComision_, "alumno")
    );

    $comision = $this->container->query("comision")->param("id",$idComision)->fields()->one();
    $comisionValue = $this->container->tools("comision")->value($comision);

    $disposicion_ = $this->disposicion_($comision["planificacion-plan"]);

    $alumno__calificacionAprobada_ = $this->alumno__calificacionAprobada_($idAlumno_, $comision["planificacion-plan"]);
    require_once("script/AsignaturasAprobadasAlumnos.html");

  }




  public function alumnoComision_($idComision){
    return $this->container->query("alumno_comision")
    ->fields(["id","alumno","estado","persona-nombres","persona-apellidos","persona-numero_documento","alumno-tramo_ingreso"])
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



  /**
   * Array asociativo id_alumno => array de calificaciones aprobadas
   */
  public function alumno__calificacionAprobada_($idAlumno_, $plan){
    if(empty($idAlumno_)) return [];
    $calificacion_ = $this->container->query("calificacion")
      ->fields(["id","alumno","nota_final","crec", "persona-nombres","persona-apellidos","persona-numero_documento","alumno-tramo_ingreso","alumno-plan","planificacion_dis-tramo","planificacion_dis-plan","disposicion-asignatura"])
      ->size(0)
      ->cond([
        ["alumno","=",$idAlumno_],
        [
          ["nota_final",">=","7"],
          ["crec",">=","4","OR"]
        ],
        ["planificacion_dis-plan","=",$plan],

      ])
      ->order(["planificacion_dis-anio"=>"ASC", "planificacion_dis-semestre"=>"ASC"])
      ->all();
    
    return array_group_value($calificacion_, "alumno");
  }

  public function disposicion_($plan){
    return $this->container->query("disposicion")
    ->fields(["id","planificacion-tramo", "asignatura", "asignatura-nombre"])
    ->size(0)
    ->cond([
      ["planificacion-plan",EQUAL,$plan],
    ])
    ->order([
      "planificacion-anio" => "ASC",
      "planificacion-semestre" => "ASC",
      "asignatura-nombre" => "ASC",
    ])
    ->all();
  }

}