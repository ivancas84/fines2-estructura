<?php

require_once("function/array_combine_key2.php");

class AlumnoTools {

  public $container;
  public $alumno;
  public $initialize = false;

  public function __construct(){
    $this->container = new Container;
  }

  public function init($id){
    $this->alumno = $this->container->getDb()->get("alumno",$id);
    $this->postInit();
  }

  public function initDni($dni){
    $render = $this->container->getRender("alumno");
    $render->setCondition(["per-numero_documento","=",$dni]);
    $this->alumno = $this->container->getDb()->one("alumno",$render);
    $this->postInit();
  }

  protected function postInit(){
    if(empty($this->alumno["anio_ingreso"])) $this->alumno["anio_ingreso"] = 1;
    $this->initialize = true;
  }

  public function getValue(){
    return $this->container->getRel("alumno")->value($this->alumno);
  }

  public function getCalificacionesAprobadas(){
    $render = $this->container->getRender("calificacion");
    $render->setCondition([
      ["alumno","=",$this->alumno["id"]],
      [
        ["nota_final",">=","7"],
        ["crec",">=","4","OR"],
      ]
    ]);
    $render->setOrder(["dis_pla-anio"=>"asc","dis_pla-semestre"=>"asc","dis_asi-nombre"=>"asc"]);
    return $this->container->getDb()->all("calificacion",$render);
  }

  public function getDisposiciones(){
    /**
     * Disposiciones que debe tener el alumno segun el plan y el anio ingreso
     */

     
    $render = $this->container->getRender("disposicion");

    $render->setCondition([
      ["pla-plan","=",$this->alumno["plan"]],
      ["pla-anio",">=",$this->alumno["anio_ingreso"]]
    ]);
    $render->setOrder(["pla-anio"=>"asc","pla-semestre"=>"asc", "asi-nombre"=>"asc"]);
    
    return $this->container->getDb()->all("disposicion",$render);
  }

  public function disposicionesRestantes($calificacionesAprobadas, $disposiciones){

    $d = array_combine_key2(
      $disposiciones,
      ["asignatura","planificacion"]
    );
    
    $ids_c = array_keys(
      array_combine_key2($calificacionesAprobadas, ["dis_asignatura", "dis_planificacion"])
    );

    $ids_d = array_keys($d);
    $ids_r = array_diff($ids_d, $ids_c);

    return array_intersect_key($d, array_flip($ids_r) );
  }

  public function disposicionesRestantesAnio($calificacionesAprobadas, $disposiciones){

    

    return array_group_value(
      $this->disposicionesRestantes($calificacionesAprobadas, $disposiciones), 
      "pla_anio"
    );
  }


  public function aniosCursados($disposicionesRestantes){
    $anios = [];
    foreach($disposicionesRestantes as $dr){
      if(!key_exists($dr["pla_anio"], $anios)) {
        $anios[$dr["pla_anio"]] = 1;
      }
      else {
        $anios[$dr["pla_anio"]]++;
      }
    }

    return $anios;
  }

  public function traducirAnios($anios){
    $anios_cursados = [];
    for($i = $this->alumno["anio_ingreso"]; $i <= 3; $i++) {
      if(!key_exists($i, $anios) ||  $anios[$i] < 5) {
        switch($i){
          case 1: array_push($anios_cursados, "Primero"); break;
          case 2: array_push($anios_cursados, "Segundo"); break;
          case 3: array_push($anios_cursados, "Tercero"); break;
        }
      }
    }
    return $anios_cursados;
  }

  
  public function traducirAniosAux($anios){
    $anios_cursados = [];
    for($i = $this->alumno["anio_ingreso"]; $i <= 3; $i++) {
      if(!key_exists($i, $anios) ||  $anios[$i] < 5) {
        switch($i){
          case 1: array_push($anios_cursados, "Primer"); break;
          case 2: array_push($anios_cursados, "Segundo"); break;
          case 3: array_push($anios_cursados, "Tercer"); break;
        }
      }
    }
    return $anios_cursados;
  }


  public function aniosRestantes($aniosCursados){
    $a = [1=>"Primero",2=>"Segundo",3=>"Tercero"];
    return array_diff($a, $aniosCursados);
  }



}