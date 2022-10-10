<?php

require_once("class/api/Base.php");
require_once("function/php_input.php");
require_once("function/array_group_value.php");
require_once("function/array_unset_keys.php");
require_once("function/array_combine_key.php");

class CantidadAsignaturasAprobadasAlumnosApi extends BaseApi {
  /**
   * Dado un numero de comision se obtienen los alumnos y la cantidad de asignaturas aprobadas
   */
  public $idComision;
  public $comision;

  public $idAlumno_ = [];
  public $alumno__calificacionAprobada_ = [];
  public $disposicion_ = [];

  public function main() {
    $this->container->getAuth()->authorize("alumno", "r");
    $this->idAlumno_ = php_input();
    $this->alumno__calificacionAprobada_();
    
    // $this->disposicion_();
    
    return $this->calcular();

  }

  // public function idAlumno_(){
  //   $render = $this->container->getRender("alumno_comision");
  //   $render->setCondition([
  //     ["comision","=",$this->comision["id"]],
  //   ]);
  //   $render->setFields(["alumno"]);
  //   $render->setSize(0);
  //   $this->idAlumno_ = array_column(
  //     $this->container->getDb()->select("alumno_comision",$render),
  //     "alumno"
  //   );
  // }


  public function alumno__calificacionAprobada_(){
    /**
     * Array asociativo id_alumno => array de calificaciones aprobadas
     */
    if(empty($this->idAlumno_)) return [];
    $render = $this->container->getRender("calificacion");
    $render->setSize(0);
    $render->setCondition([
      ["alumno","=",$this->idAlumno_],
      [
        ["nota_final",">=","7"],
        ["crec",">=","4","OR"]
      ]
    ]);
    //$render->setFields(["cantidad"=>"id.count"]);
    //$render->setGroup(["alumno"=>"alumno"]);
    
    $this->alumno__calificacionAprobada_ = array_group_value(
      $this->container->getDb()->all("calificacion",$render),
      "alumno"
    );
  }


  // public function disposicion_(){
  //   $render = $this->container->getRender("disposicion");
  //   $render->setSize(0);
  //   $render->setCondition([
  //     ["plan-id","=",$this->comision["plan_id"]],
  //   ]);
  //   $render->setOrder(["planificacion-anio"=>"asc","planificacion-semestre"=>"asc", "asignnatura-nombre"=>"asc"]);
    
  //   $this->disposicion_ = array_combine_key(
  //     $this->container->getDb()->all("disposicion",$render),
  //     "id"
  //   );
  // }


  public function calcular(){
    $respuesta = [];

    foreach($this->alumno__calificacionAprobada_ as $alumno => $calificacionAprobada_){
      $r = [];
      $r["alumno"] = $alumno;
      $r["cantidad_aprobada"] = count($calificacionAprobada_);
      $idDisposicionAprobada_ = array_column($calificacionAprobada_, "disposicion");
      $disposicionDesaprobada_ = array_unset_keys($this->disposicion_, $idDisposicionAprobada_);
      
      $anioIngreso = (empty($calificacionAprobada_[0]["alu_anio_ingreso"])) ? 1 : intval($calificacionAprobada_[0]["alu_anio_ingreso"]);  
      $disposicionDesaprobadaResultante_ = [];
      foreach($disposicionDesaprobada_ as $dd){
        if(intval($dd["pla_anio"]) < $anioIngreso) continue;
        array_push($disposicionDesaprobadaResultante_, $dd);
      }
      $r["cantidad_no_aprobada"] = count($disposicionDesaprobadaResultante_);
      $r["_disposicion_no_aprobada"] = $disposicionDesaprobadaResultante_;
      array_push($respuesta, $r);
    }
    return $respuesta;
  }
}
