<?php

require_once("class/import/Import.php");
require_once("class/model/Db.php");

class CalificacionImport extends Import{
  /**
   * Importar Calificaciones
   */
  public $entityName = "calificacion";
  public $mode = "tab";
  public $id = "calificacion";
  public $idCurso;
  

  public function main(){
    $this->container->getEntity("calificacion")->identifier = ["per-numero_documento", "curso"];
    parent::main();
  }
  
  public function identify(){
    $this->ids["persona"] = [];
    $this->ids["calificacion"] = [];
    foreach($this->elements as &$element){
      $dni = $element->entities["persona"]->_get("numero_documento");

      if(Validation::is_empty($dni)){
        $element->process = false;                
        $element->logs->addLog("persona", "error", "El número de documento no se encuentra definido");
        continue;
      }

      if(Validation::is_empty($this->idCurso)){
        $element->process = false;                
        $element->logs->addLog("curso", "error", "El identificador de curso no se encuentra definido");
        continue;
      }

      $idCalificacion = $dni.UNDEFINED.$this->idCurso;
      $element->entities["calificacion"]->_set("identifier", $idCalificacion);

      if(in_array($idCalificacion, $this->ids["calificacion"])) {
        $element->logs->addLog("calificacion","error","La calificacion se encuentra dos veces en la misma planilla");
        $element->process = false;
        continue;        
      }
      array_push($this->ids["calificacion"], $idCalificacion);
      
      if(in_array($dni, $this->ids["persona"])) $element->logs->addLog("persona","warning","El número de documento está duplicado");
      else array_push($this->ids["persona"], $dni);
    }

    

  }

  public function query(){
    $this->queryEntityField("persona","numero_documento");
    $this->queryEntityField("calificacion","identifier");
  }

  public function process(){    
    foreach($this->elements as &$element) {
      if(!$element->process) continue;
     
      $dni = $element->entities["persona"]->_get("numero_documento");
      
      if(key_exists($dni, $this->dbs["persona"])){
        $personaExistente = $this->container->getValue("persona");
        $personaExistente->_fromArray($this->dbs["persona"][$dni], "set");
        if(!$element->entities["persona"]->checkNombresParecidos($personaExistente)){
          $element->logs->addLog("persona", "error", "En la base existe una persona cuyos datos no coinciden");
          continue;
        }
      }
      $this->processElement($element, "persona", $dni);

      $element->entities["calificacion"]->_set("curso",$this->idCurso);
      $element->entities["calificacion"]->_set("persona",$element->entities["persona"]->_get("id"));
      $idCalificacion = $element->entities["calificacion"]->_get("identifier");
      $this->processElement($element, "calificacion", $idCalificacion);
    }
  }
}