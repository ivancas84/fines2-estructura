<?php

require_once("import/Import.php");
require_once("model/Db.php");
require_once("tools/Validation.php");
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

    $this->comision = $this->container->query("comision")->fields()->param("id", $this->idComision)->one();
    $this->tieneAnterior(); 

    $this->container->entity("persona")->identifier = ["numero_documento"];
    $this->container->entity("alumno")->identifier = ["persona-numero_documento"];
    $this->container->entity("alumno_comision")->identifier = ["persona-numero_documento", "comision"];
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

    $this->queryOtraComisionPeriodoAnterior_();
    if($this->tieneAnterior){
      $this->queryCalificacionesAprobadasPeriodoAnterior_();
      $this->queryComisionPeriodoAnterior_();
    } 
  }


  public function tieneAnterior(){
      $count = intval(
          $this->container->query("comision")
          ->cond(["comision_siguiente","=",$this->idComision])
          ->size(0)
          ->page(1)
          ->fields(["count"])
          ->columnOne()
      );
  
      $this->tieneAnterior = ($count) ? true : false;
  }

  public function queryOtraComisionPeriodoAnterior_(){

    $cal = periodo_calendario_anterior($this->anio, $this->semestre);
    $rows = $this->container->query("alumno_comision")
      ->size(false)
      ->fields()
      ->cond(["persona-numero_documento","=",$this->ids["persona"]])
      ->cond(["comision","!=",$this->idComision])
      ->cond(["activo","=",true])
      ->all();

    foreach($rows as $row) {
      if(($row["comision_division"] != $this->comision["division"]) || ($row["comision_sede"] != $this->comision["sede"]) ){
        array_push($this->alumnoOtraComision_, $row );
      }
    }
  }

  
  public function queryCalificacionesAprobadasPeriodoAnterior_() {
      $periodoAnterior = periodo_anterior2($this->comision, "planificacion_");
      $rows = $this->container->query("calificacion")
          ->size(false)
          ->fieldsTree()
          ->fields(["cantidad"=>"count"])
          ->group(["persona-numero_documento"])
          ->cond(["persona-numero_documento","=",$this->ids["persona"]])
          ->cond(["planificacion-anio","=",$periodoAnterior["anio"]])
          ->cond(["planificacion-semestre","=",$periodoAnterior["semestre"]])
          ->cond([
              ["nota_final",">=","7"],
              ["crec",">=","4","OR"]
          ])->all();
      
      $this->calificacionesAprobadasPeriodoAnterior_ = array_combine_key(
          $rows,
          "persona_numero_documento"
      );  
  }

  public function queryComisionPeriodoAnterior_(){
      $rows = $this->container->query("alumno_comision")
          ->fields()
          ->size(false)
          ->cond(["comision-comision_siguiente","=",$this->idComision])
          ->cond(["activo","=",true])
          ->all();
      
      foreach($rows as $row) array_push($this->dniComisionPeriodoAnterior_, $row["persona_numero_documento"]);
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
    if(count($this->alumnoOtraComision_)){
      echo "<h3>Alumnos que  se encuentran cargados en otra comision</h3>";
      echo "<ul>";
      foreach($this->alumnoOtraComision_ as $aoc){
        $a = $this->container->tools("alumno_comision")->value($aoc);
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