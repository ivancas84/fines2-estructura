<?php

require_once("class/import/Import.php");
require_once("class/model/Db.php");
require_once("class/tools/Validation.php");

class AlumnosComisionImport extends Import{
  /**
   * Importar Alumnos de Comision
   */

  public $id = "alumnos_comision"; //identificacion de la importacion (para facilitara la instanciacion de la clase Element)
  public $mode = "tab";
  public $idComision;
  public $dniExistente_ = [];
  /**
   * @property $dni_: Alumnos existentes en la comisión
   */

  public function main(){
    if(Validation::is_empty($this->idComision)) throw new Exception("El id del curso no se encuentra definido");

  
    $this->container->getEntity("alumno")->identifier = ["per-numero_documento"];
    $this->container->getEntity("alumno_comision")->identifier = ["alu_per-numero_documento", "comision"];

    parent::main();
    // $this->define();
    // $this->identify();
    // $this->query();
    // $this->process();
    // echo "<pre>";
    // print_r($this);

  }

  public function identify(){
    $this->ids["persona"] = [];
    $this->ids["alumno"] = [];
    $this->ids["alumno_comision"] = [];

    
    foreach($this->elements as &$element){
      if(!$element->process) continue;
      if(!($dni = $element->getIdentifier("persona", "numero_documento"))) continue;
      if(!($idAlumno = $element->getIdentifier("alumno"))) continue;
      if(!($idAlumnoComision = $element->getIdentifier("alumno_comision"))) continue;

      if(!$this->idEntityFieldCheck("alumno", $idAlumno, $element)) continue;
      if(!$this->idEntityFieldCheck("persona", $dni, $element)) continue;
      if(!$this->idEntityFieldCheck("alumno_comision", $idAlumnoComision, $element)) continue;
    }
  }

  public function query(){
    $this->queryEntityField("persona","numero_documento");
    $this->queryEntityField("alumno");
    $this->queryEntityField("alumno_comision");
  }

  public function process(){    
    foreach($this->elements as &$element) {
      if(!$element->process) continue;

      if(!$idPersona = $this->processPersona($element)) continue;

      $element->entities["alumno"]->_set("persona",$idPersona);
      if(!$idAlumno = $this->processElement($element,"alumno")) continue;

      $element->entities["alumno_comision"]->_set("alumno",$idAlumno);

      if(!$this->processElement($element,"alumno_comision")) continue;

    }
  }

  public function processPersona(&$element){
    $dni = $element->entities["persona"]->_get("numero_documento");
    if(key_exists($dni, $this->dbs["persona"])){
      $personaExistente = $this->container->getValue("persona");
      $personaExistente->_fromArray($this->dbs["persona"][$dni], "set");
      if(!$element->entities["persona"]->checkNombresParecidos($personaExistente)){
        $element->logs->addLog("persona", "error", "En la base existe una persona cuyos datos no coinciden");
        $element->process = false;
        return false;
      }
    }
    
    return $this->processElement($element,"persona","numero_documento", false);
  }

}