<?php

require_once("class/import/Import.php");
require_once("class/model/Db.php");
require_once("class/tools/Validation.php");

class AlumnosComisionImport extends Import{
  /**
   * Importar Alumnos de Comision
   */

  public $idComision;
  public $anio = 2022; //anio calendario de la comision
  public $semestre = 2; //semestre calendario de la comision
  public $comision; //datos de la comision actualmente siendo procesada
  public $alumnosDeOtraComision = [];

  public function config(){
    if(Validation::is_empty($this->idComision)) throw new Exception("El id no se encuentra definido");

    $this->container->getEntity("persona")->identifier = ["numero_documento"];
    $this->container->getEntity("alumno")->identifier = ["per-numero_documento"];
    $this->container->getEntity("alumno_comision")->identifier = ["alu_per-numero_documento", "comision"];
  }

  public function main(){
    $this->config(); 
    $this->define();
    $this->identify();
    $this->query();
    $this->process();
    //$this->persist();
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
    $this->queryEntityField("persona");
    $this->queryEntityField("alumno");
    $this->queryEntityField("alumno_comision");

    $this->comision = $this->container->getDb()->get("comision", $this->idComision);
    $this->queryOtraComisionPeriodoAnterior_();
    $this->queryComisionPeriodoAnterior_();
  }


  public function queryOtraComisionPeriodoAnterior_(){
    $render = $this->container->getRender("alumno_comision");
    $render->setSize(false);
    $render->addCondition(["alu_per-numero_documento","=",$this->ids["persona"]]);
    $render->addCondition(["com_cal-anio","=",$this->anio]);
    $render->addCondition(["com_cal-semestre","=",($this->semestre - 1)]);
    $render->addCondition(["comision","!=",$this->idComision]);
    $render->addCondition(["activo","=",true]);

    $rows = $this->container->getDb()->all("alumno_comision", $render);
    foreach($rows as $row) {
      echo $row["com_division"] . " " . $this->comision["division"];
      echo $row["com_sede"] . " " . $this->comision["sede"];
       
      if(($row["com_division"] != $this->comision["division"]) || ($row["com_sede"] != $this->comision["sede"]) ){
        $data = [
          "numero_documento" => $row["alu_per_numero_documento"],
          "division" => $row["com_sed_numero"].$row["com_division"],
        ];
        
        array_push($this->alumnosDeOtraComision, $data );
      }
    }
  }

  public function queryComisionPeriodoAnterior_(){
    $render = $this->container->getRender("alumno_comision");
    $render->setSize(false);
    $render->addCondition(["com-comision_siguiente","=",$this->idComision]);
    $render->addCondition(["activo","=",true]);

    $rows = $this->container->getDb()->all("alumno_comision", $render);
    foreach($rows as $row) {
      echo $row["com_division"] . " " . $this->comision["division"];
      echo $row["com_sede"] . " " . $this->comision["sede"];
       
      if(($row["com_division"] != $this->comision["division"]) || ($row["com_sede"] != $this->comision["sede"]) ){
        $data = [
          "numero_documento" => $row["alu_per_numero_documento"],
          "division" => $row["com_sed_numero"].$row["com_division"],
        ];
        
        array_push($this->alumnosDeOtraComision, $data );
      }
    }
  }

  public function process(){    
    foreach($this->elements as &$element) {
      if(!$element->process) continue;
      try{
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

  
}