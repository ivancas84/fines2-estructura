<?php

require_once("function/php_input.php");
require_once("function/array_group_value.php");


class CantidadAsignaturasAprobadasAlumnosTramo  {
  /**
   * Dado un numero de comision se obtienen los alumnos y la cantidad de asignaturas aprobadas
   */
  public $idComision;
  public $comision;

  public $idAlumno_ = [];
  public $alumno__calificacionAprobada_ = [];
  public $disposicion_ = [];

  public function main(array $idAlumno_) {
    $this->idAlumno_ = $idAlumno_;
    $this->alumno__calificacionAprobada_();
    return $this->calcular();
  }

  public function alumno__calificacionAprobada_(){
    /**
     * Array asociativo id_alumno => array de calificaciones aprobadas
     */
    if(empty($this->idAlumno_)) return [];
    $calificacion_ = $this->container->query("calificacion")->fields()
    ->size(0)->cond([
      ["alumno","=",$this->idAlumno_],
      [
        ["nota_final",">=","7"],
        ["crec",">=","4","OR"]
      ]
    ])
    ->order(["planificacion_dis-anio"=>"ASC", "planificacion_dis-semestre"=>"ASC"])->all();
    
    $this->alumno__calificacionAprobada_ = array_group_value(
      $calificacion_,
      "alumno"
    );
  }

  public function calcular(){
    $respuesta = [];

    foreach($this->alumno__calificacionAprobada_ as $alumno => $calificacionAprobada_){
      $r = [];
      $r["alumno"] = $alumno;
      $r["cantidad_aprobadas_11"] = 0;
      $r["cantidad_aprobadas_12"] = 0;
      $r["cantidad_aprobadas_21"] = 0;
      $r["cantidad_aprobadas_22"] = 0;
      $r["cantidad_aprobadas_31"] = 0;
      $r["cantidad_aprobadas_32"] = 0;
      $r["cantidad_aprobadas"] = 0;

      foreach($calificacionAprobada_ as $ca){
        if((intval($ca["planificacion_dis_tramo"]) < intval($ca["alumno_tramo_ingreso"]))
          || ($ca["planificacion_dis_plan"] != $ca["alumno_plan"])) continue;
          
        $r["cantidad_aprobadas_".$ca["planificacion_dis_tramo"]]++;
      }

      $r["cantidad_aprobadas"] = $r["cantidad_aprobadas_11"]+$r["cantidad_aprobadas_12"]+$r["cantidad_aprobadas_21"]+$r["cantidad_aprobadas_22"]+$r["cantidad_aprobadas_31"]+$r["cantidad_aprobadas_32"];
      array_push($respuesta, $r);
    }
    return $respuesta;
  }
}
