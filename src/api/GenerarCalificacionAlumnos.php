<?php

require_once("api/Base.php");
require_once("function/php_input.php");

require_once("function/array_group_value.php");
require_once("function/array_unset_keys.php");
require_once("function/array_combine_key.php");

class GenerarCalificacionAlumnosApi extends BaseApi {

  public $idComision;
  public $comision;

  public $idAlumno_ = [];
  public $idAlumno_calificacion_ = [];
  public $disposicion_ = [];
  public $sql = "";
  public $detail = [];
  
  public function main() {
    $this->container->getAuth()->authorize("calificacion", "w");
    $this->idComision = php_input()["id"];
    $this->comision = $this->container->db()->get("comision", $this->idComision);

    $this->idAlumno_();
    $this->idAlumno_calificacion_();
    $this->disposicion_();
    $this->setCalificacionFaltate_();

    $this->idAlumnoSinCalificacion_ = array_diff($this->idAlumno_, array_keys($this->idAlumno_calificacion_));
    $this->alumnoSinCalificacion_ = $this->container->db()->getAll("alumno",$this->idAlumnoSinCalificacion_);
    $this->setCalificacion_();
    

    if($this->sql) $this->container->db()->multi_query_transaction($this->sql);
    return ["detail"=>$this->detail];
  }


  public function idAlumno_(){
    $render = $this->container->getEntityRender("alumno_comision");
    $render->setCondition([
      ["comision","=",$this->comision["id"]],
    ]);
    $render->setFields(["alumno"]);
    $render->setSize(0);
    $this->idAlumno_ = array_column(
      $this->container->db()->select("alumno_comision",$render),
      "alumno"
    );
  }



  public function idAlumno_calificacion_(){
    /**
     * Array asociativo id_alumno => array de calificaciones aprobadas
     */
    if(empty($this->idAlumno_)) return [];
    $render = $this->container->getEntityRender("calificacion");
    $render->setSize(0);
    $render->setCondition([
      ["alumno","=",$this->idAlumno_],
      ["plan-id","=",$this->comision["plan_id"]],
    ]);
    //$render->setFields(["cantidad"=>"id.count"]);
    //$render->setGroup(["alumno"=>"alumno"]);
    
    $this->idAlumno_calificacion_ = array_group_value(
      $this->container->db()->all("calificacion",$render),
      "alumno"
    );


  }

  public function disposicion_(){
    $render = $this->container->getEntityRender("disposicion");
    $render->setSize(0);
    $render->setCondition([
      ["plan-id","=",$this->comision["plan_id"]],
    ]);
    $render->setOrder(["planificacion-anio"=>"asc","planificacion-semestre"=>"asc", "asignatura-nombre"=>"asc"]);
    
    $this->disposicion_ = array_combine_key(
      $this->container->db()->all("disposicion",$render),
      "id"
    );
  }


  public function setCalificacionFaltate_(){
    foreach($this->idAlumno_calificacion_ as $idAlumno => $calificacion_){
      $r = [];
      $r["alumno"] = $idAlumno;
      $idDisposicion_ = array_column($calificacion_, "disposicion");
      $disposicion_ = array_unset_keys($this->disposicion_, $idDisposicion_);
      
      $anioIngreso = (empty($calificacion_[0]["alu_anio_ingreso"])) ? 1 : intval($calificacion_[0]["alu_anio_ingreso"]);  

      foreach($disposicion_ as $dd){
        if(intval($dd["pla_anio"]) < $anioIngreso) continue;

        $a = [
          "alumno" => $idAlumno,
          "disposicion" => $dd["id"]
        ];

        $persist = $this->container->controller("persist_sql", "calificacion")->id($a);
        $this->sql .= $persist["sql"];
        array_push($this->detail, "calificacion".$persist["id"]);
      }
    }
  }

  public function setCalificacion_(){
    foreach($this->alumnoSinCalificacion_ as $alumno){
      $r = [];
      $r["alumno"] = $alumno["id"];
    
      $anioIngreso = (empty($alumno["anio_ingreso"])) ? 1 : intval($alumno["anio_ingreso"]);  

      foreach($this->disposicion_ as $dd){
        if(intval($dd["pla_anio"]) < $anioIngreso) continue;

        $a = [
          "alumno" => $alumno["id"],
          "disposicion" => $dd["id"]
        ];

        $persist = $this->container->controller("persist_sql", "calificacion")->id($a);
        $this->sql .= $persist["sql"];
        array_push($this->detail, "calificacion".$persist["id"]);
      }
    }
  }


  
}
