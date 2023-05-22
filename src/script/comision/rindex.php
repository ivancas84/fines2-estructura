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
require_once("function/get-semester.php");



class ComisionRindexScript extends BaseController {

  function main() {
    $id_comision = $_REQUEST["id"];
    $alumno_comision = $this->_alumno_comision_all($id_comision);

    $ids_alumno = array_column($alumno_comision, "alumno");
    $comision = $alumno_comision[0];
    $disposiciones = $this->disposicion_all($alumno_comision[0]["planificacion-plan"]);
    $calificaciones = $this->alumno_calificacion_aprobada_all($ids_alumno, $alumno_comision[0]["planificacion-plan"]);
    require_once("script/comision/rindex.html");

  }




    public function _alumno_comision_all($id_comision){
        return $this->container->query("alumno_comision")
        ->fields()
        ->size(0)
        ->cond([
            ["estado",NONEQUAL,"Mesa"],
            ["comision-id","=",$id_comision],
        ])
        ->order([
            "persona-apellidos"=>"ASC",
            "persona-nombres"=>"ASC",
        ])->all();
    }



  /**
   * Array asociativo id_alumno => array de calificaciones aprobadas
   */
  public function alumno_calificacion_aprobada_all($ids_alumno, $plan){
    if(empty($ids_alumno)) return [];
    $calificacion_ = $this->container->query("calificacion")
      ->fields(["id","alumno","nota_final","crec", "persona-nombres","persona-apellidos","persona-numero_documento","alumno-tramo_ingreso","alumno-plan","planificacion_dis-tramo","planificacion_dis-plan","disposicion-asignatura"])
      ->size(0)
      ->cond([
        ["alumno","=",$ids_alumno],
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

  public function disposicion_all($plan){
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

  public function fechaIngreso(DateTime $alta){
    return getSemester($alta) . "ºC " ;  
  }

  public function estado($estado, $ingreso){
      if($estado == "No activo") return "TRAYECTORIA INTERRUMPIDA";
      if($estado == "Activo" && $ingreso == "20222") return "INGRESANTE";
      if($estado == "Activo" && $ingreso != "2ºC 2022") return "CONTINUA TRAYECTORIA";
      return $estado;
  }
}