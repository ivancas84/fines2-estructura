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
    $render = $this->container->getEntityRender("alumno");
    $render->setCondition(["persona-numero_documento","=",$dni]);
    $this->alumno = $this->container->getDb()->one("alumno",$render);
    $this->postInit();
  }

  protected function postInit(){
    if(empty($this->alumno["anio_ingreso"])) $this->alumno["anio_ingreso"] = 1;
    $this->initialize = true;
  }

  public function getValue(){
    return $this->container->tools("alumno")->value($this->alumno);
  }

  public function getCalificacionesAprobadas(){
    $render = $this->container->getEntityRender("calificacion");
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
  
  public function getCalificacionesAprobadasPlan($plan){
    $render = $this->container->getEntityRender("calificacion");
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

     
    $render = $this->container->getEntityRender("disposicion");

    $render->setCondition([
      ["plan-id","=",$this->alumno["plan"]],
      ["planificacion-anio",">=",$this->alumno["anio_ingreso"]]
    ]);
    $render->setOrder(["pla-anio"=>"asc","pla-semestre"=>"asc", "asi-nombre"=>"asc"]);
    
    return $this->container->getDb()->all("disposicion",$render);
  }

  public function disposicionesRestantes($calificacionesAprobadas, $disposiciones){
    /**
     * @derecated? 
     */
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

  public function disposicionesPendientes(){
    $render = $this->container->getEntityRender("disposicion_pendiente");
    $render->setCondition([
      ["alumno","=",$this->alumno["id"]],
    ]);
    $render->setOrder(["planificacion-anio"=>"asc","planificacion-semestre"=>"asc","asignatura-nombre"=>"asc"]);
    return $this->container->getDb()->all("disposicion_pendiente",$render);
  }

  public function disposicionesRestantesAnio($calificacionesAprobadas, $disposiciones){

    return array_group_value(
      $this->disposicionesRestantes($calificacionesAprobadas, $disposiciones), 
      "pla_anio"
    );
  }

  

  public function sumaDisposicionesPorAnio($disposicionesRestantes){
    /**
     * sumar por anio las disposiciones que faltan, con esa info se puede cal-
     * cular los años cursados.
     * 
     * [
     *   1 => 2
     *   2 => 3
     *   3 => 1
     * ] 
     */
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

  public function anioActual2($anios){
    if(!rsort($anios)) throw new Exception("Error al ordenar");
    $i = (count($anios)) ? $anios[0] : 1;

    switch($i){
      case 1: return "Primero";
      case 2: return "Segundo";
      default: return "Tercer";
    }
  }

  public function anioActual($anios){
    $anios_cursados = [];
    
    for($i = $this->alumno["anio_ingreso"]; $i <= 3; $i++) {
      if(!key_exists($i, $anios)) continue;
      else break;
    }

    switch($i){
      case 1: return "Primero";
      case 2: return "Segundo";
      default: return "Tercero";
    }
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
    if(in_array("Tercero",$aniosCursados)) return [];
    if(in_array("Segundo",$aniosCursados)) return ["Tercero"];
    if(in_array("Primero",$aniosCursados)) return ["Segundo","Tercero"];
    return ["Primero","Segundo","Tercero"];
  }



}