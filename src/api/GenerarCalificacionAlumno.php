<?php

require_once("api/Base.php");
require_once("function/php_input.php");

require_once("function/array_group_value.php");
require_once("function/array_unset_keys.php");
require_once("function/array_combine_key.php");

class GenerarCalificacionAlumnoApi extends BaseApi {

  public $idAlumno;
  public $alumno;
  public $calificacion_ = [];

  
  
  public $disposicion_ = [];
  public $sql = "";
  public $detail = [];
  
  public function main() {
    $this->container->getAuth()->authorize("calificacion", "w");
    $this->idAlumno = file_get_contents("php://input");


    $this->alumno = $this->container->db()->get("alumno",$this->idAlumno);

    $this->calificacion_(); //calificaciones del alumno
    $this->disposicion_(); //disposiciones del plan del alumno
    $this->setCalificacionFaltate_(); //agregar calificaciones faltantes del alumno
    
    if($this->sql) $this->container->db()->multi_query_transaction($this->sql);
    return ["id"=>$this->idAlumno, "detail"=>$this->detail];
  }





  public function calificacion_(){
    /**
     * Array asociativo id_alumno => array de calificaciones aprobadas
     */
    $render = $this->container->getEntityRender("calificacion");
    $render->setSize(0);
    $render->setCondition([
      ["alumno","=",$this->idAlumno],
      ["plan-id","=",$this->alumno["plan"]],
    ]);
    //$render->setFields(["cantidad"=>"id.count"]);
    //$render->setGroup(["alumno"=>"alumno"]);
    
    $this->calificacion_ = $this->container->db()->all("calificacion",$render);


  }

  public function disposicion_(){
    $render = $this->container->getEntityRender("disposicion");
    $render->setSize(0);
    $render->setCondition([
      ["plan-id","=",$this->alumno["plan"]],
    ]);
    $render->setOrder(["planificacion-anio"=>"asc","planificacion-semestre"=>"asc", "asignatura-nombre"=>"asc"]);
    
    $this->disposicion_ = array_combine_key(
      $this->container->db()->all("disposicion",$render),
      "id"
    );
  }


  public function setCalificacionFaltate_(){
      $anioIngreso = (empty($this->alumno["anio_ingreso"])) ? 1 : intval($this->alumno["anio_ingreso"]);  

      $idDisposicion_ = array_column($this->calificacion_, "disposicion");
      $disposicion_ = array_unset_keys($this->disposicion_, $idDisposicion_);
      
      foreach($disposicion_ as $dd){
        if(intval($dd["pla_anio"]) < $anioIngreso) continue;

        $a = [
          "alumno" => $this->idAlumno,
          "disposicion" => $dd["id"]
        ];

        $persist = $this->container->controller("persist_sql", "calificacion")->id($a);
        $this->sql .= $persist["sql"];
        array_push($this->detail, "calificacion".$persist["id"]);
      }
  }
  
}
