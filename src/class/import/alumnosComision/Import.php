<?php

require_once("class/import/Import.php");
require_once("class/model/Db.php");
require_once("class/tools/Validation.php");
require_once("function/periodo_anterior.php");
require_once("function/periodo_calendario_anterior.php");

require_once("function/array_combine_key.php");

class AlumnosComisionImport extends Import{
  /**
   * Importar Alumnos de Comision
   */

  public $idComision;
  public $anio; //anio calendario de la comision
  public $semestre; //semestre calendario de la comision
  public $comision; //datos de la comision actualmente siendo procesada
  public $alumnoOtraComision_ = [];
  public $dniComisionPeriodoAnterior_ = [];
  public $alumnoSinComisionPeriodoAnterior_ = [];
  public $calificacionesAprobadasPeriodoAnterior_ = [];
  public $tieneAnterior_ = false;
  public $alumnoMenos3CalificacionesAprobadas_ = [];



  public function config(){
    if(Validation::is_empty($this->idComision)) throw new Exception("El id no se encuentra definido");

    $this->container->getEntity("persona")->identifier = ["numero_documento"];
    $this->container->getEntity("alumno")->identifier = ["per-numero_documento"];
    $this->container->getEntity("alumno_comision")->identifier = ["alu_per-numero_documento", "comision"];
  }

  public function identify(){
    foreach($this->elements as &$element){
      if(!$element->process) continue;
      try{
        $element->identifyCheck("alumno");
        $element->identifyCheck("persona");
        $element->identifyCheck("alumno_comision");
      } catch(Exception $exception){
        $element->process = false;
        $element->logs->addLog("identify","error",$exception->getMessage());
      }
    }
  }

  public function query(){
    $this->queryEntity("persona");
    $this->queryEntity("alumno");
    $this->queryEntity("alumno_comision");

    $this->comision = $this->container->getDb()->get("comision", $this->idComision);
    $this->tieneAnterior(); 
    $this->queryOtraComisionPeriodoAnterior_();
    if($this->tieneAnterior){
      $this->queryCalificacionesAprobadasPeriodoAnterior_();
      $this->queryComisionPeriodoAnterior_();
    } 
  }


  public function tieneAnterior(){
      $render = $this->container->getEntityRender("comision");
      $render->addCondition(["comision_siguiente","=",$this->idComision]);
  
      $count = $this->container->getDb()->count("comision", $render);
      $this->tieneAnterior = ($count) ? true : false;
  }

  public function queryOtraComisionPeriodoAnterior_(){

    $cal = periodo_calendario_anterior($this->anio, $this->semestre);
    $render = $this->container->getEntityRender("alumno_comision");
    
    $render->setSize(false);
    $render->addCondition(["alu_per-numero_documento","=",$this->ids["persona"]]);
    $render->addCondition(["comision","!=",$this->idComision]);
    $render->addCondition(["activo","=",true]);

    $rows = $this->container->getDb()->all("alumno_comision", $render);
    foreach($rows as $row) {
      if(($row["com_division"] != $this->comision["division"]) || ($row["com_sede"] != $this->comision["sede"]) ){
        array_push($this->alumnoOtraComision_, $row );
      }
    }
  }

  
  public function queryCalificacionesAprobadasPeriodoAnterior_(){
    $periodoAnterior = periodo_anterior2($this->comision, "pla_");
    $render = $this->container->getEntityRender("calificacion");
    $render->setSize(false);
    $render->setFields(["cantidad"=>"count"]);
    $render->setGroup(["alu_per-numero_documento"]);
    $render->addCondition(["alu_per-numero_documento","=",$this->ids["persona"]]);
    $render->addCondition(["dis_pla-anio","=",$periodoAnterior["anio"]]);
    $render->addCondition(["dis_pla-semestre","=",$periodoAnterior["semestre"]]);
    $render->addCondition([
      ["nota_final",">=","7"],
      ["crec",">=","4","OR"]
    ]);
    
    $this->calificacionesAprobadasPeriodoAnterior_ = array_combine_key(
      $this->container->getDb()->select("calificacion", $render),
      "alu_per_numero_documento"
    );  
  }

  public function queryComisionPeriodoAnterior_(){
    $render = $this->container->getEntityRender("alumno_comision");
    $render->setSize(false);
    $render->addCondition(["com-comision_siguiente","=",$this->idComision]);
    $render->addCondition(["activo","=",true]);

    $rows = $this->container->getDb()->all("alumno_comision", $render);
    foreach($rows as $row) array_push($this->dniComisionPeriodoAnterior_, $row["alu_per_numero_documento"]);
  }

  

  public function process(){    
    foreach($this->elements as &$element) {
      if(!$element->process) continue;
      try{
        if(!in_array($element->entities["alumno"]->_get("identifier"), $this->dniComisionPeriodoAnterior_)){
          $element->logs->addLog("process","info","El alumno no se encuentra en la comision del periodo anterior");
          array_push($this->alumnoSinComisionPeriodoAnterior_, $element->entities["persona"]);
        }
        if(!array_key_exists($element->entities["alumno"]->_get("identifier"), $this->calificacionesAprobadasPeriodoAnterior_)){
          if(in_array($element->entities["alumno"]->_get("identifier"), $this->dniComisionPeriodoAnterior_)) array_push($this->alumnoMenos3CalificacionesAprobadas_, $element->entities["persona"]);
        } else if($this->calificacionesAprobadasPeriodoAnterior_[$element->entities["alumno"]->_get("identifier")] < 3) {
          if(in_array($element->entities["alumno"]->_get("identifier"), $this->dniComisionPeriodoAnterior_)) array_push($this->alumnoMenos3CalificacionesAprobadas_, $element->entities["persona"]);
        }
        $idPersona = $element->process("persona");
        $element->entities["alumno"]->_set("persona",$idPersona);
        $idAlumno = $element->process("alumno");
        $element->entities["alumno_comision"]->_set("alumno",$idAlumno);
        $element->process("alumno_comision");
      } catch(Exception $exception){
        $element->process = false;
        $element->logs->addLog("process", "error", $exception->getMessage());
      }
      
    }
  }
 
  public function summaryAlumnoSinComisionPeriodoAnterior_(){
    if(count($this->alumnoSinComisionPeriodoAnterior_)){
      echo "<h3>Alumnos que no se encuentran cargados en la comision del periodo anterior</h3>";
      echo "<ul>";
      foreach($this->alumnoSinComisionPeriodoAnterior_ as $a){
        echo "<li>".$a->_get("nombres") . " " . $a->_get("apellidos") . " " . $a->_get("numero_documento") . "</li>"; 
      }
      echo "</ul>";

    }
  }

  public function summaryAlumnoMenos3CalificacionesAprobaadas_(){
    if(count($this->alumnoMenos3CalificacionesAprobadas_)){
      echo "<h3>Alumnos que tienen menos de 3 calificaciones aprobadas en el periodo anterior</h3>";
      echo "<ul>";
      foreach($this->alumnoMenos3CalificacionesAprobadas_ as $a){
        echo "<li>".$a->_get("nombres") . " " . $a->_get("apellidos") . " " . $a->_get("numero_documento") . "</li>"; 
      }
      echo "</ul>";

    }
  }


  public function summaryAlumnoOtraComision_(){
    echo "<pre>";
    print_r($this->alumnoOtraComision_);
    if(count($this->alumnoOtraComision_)){
      echo "<h3>Alumnos que  se encuentran cargados en otra comision</h3>";
      echo "<ul>";
      foreach($this->alumnoOtraComision_ as $aoc){
        $a = $this->container->getEntityTools("alumno_comision")->value($aoc);
        echo "<li>".$a["persona"]->_get("nombres") . " " . $a["persona"]->_get("apellidos") . " " . $a["persona"]->_get("numero_documento") . " (" . $a["sede"]->_get("numero") . $a["comision"]->_get("division") . "/" . $a["planificacion"]->_get("anio").$a["planificacion"]->_get("semestre") . " / " . $a["calendario"]->_get("anio","Y")."-".$a["calendario"]->_get("semestre").")</li>"; 
      }
      echo "</ul>";

    }
  }


  public function summary() {
    parent::summary();
    $this->summaryAlumnoOtraComision_();
    if($this->tieneAnterior){
      $this->summaryAlumnoSinComisionPeriodoAnterior_();
      $this->summaryAlumnoMenos3CalificacionesAprobaadas_();
    }
  }
  
}