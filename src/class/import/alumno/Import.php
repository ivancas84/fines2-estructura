<?php

require_once("class/import/Import.php");
require_once("class/model/Db.php");

class AlumnoImport extends Import{

  public $mode = "db";
  public $id = "alumno";

  public function defineSource(){
    $db = new Db(ALU_HOST, ALU_USER, ALU_PASS, ALU_DBNAME);
    $result = $db->query("
      SELECT *, id_comision as com_identificacion 
      FROM persona 
      WHERE cens = '456'
      AND id_comision IS NOT NULL");
    $this->source = $result->fetch_all(MYSQLI_ASSOC);
    $result->free();

  }

  public function identify(){
    $this->ids["persona"] = [];
    $this->ids["comision"] = [];
    $this->ids["alumno"] = [];
    foreach($this->elements as &$element){
      $dni = $element->entities["persona"]->_get("numero_documento");
      $idComision = $element->entities["comision"]->_get("identificacion");

      if(Validation::is_empty($dni)){
        $element->process = false;                
        $element->logs->addLog("persona", "error", "El número de documento no se encuentra definido");
        continue;
      }

      if(Validation::is_empty($idComision)){
        $element->process = false;                
        $element->logs->addLog("comision", "error", "El identificador de comision no se encuentra definido");
        continue;
      }

      $idAlumno = $dni.UNDEFINED.$idComision;
      $element->entities["alumno"]->_set("identifier", $idAlumno);

      if(in_array($idAlumno, $this->ids["alumno"])) {
        $element->logs->addLog("alumno","error","El alumno se encuentra dos veces en la misma comisión");
        $element->process = false;
        continue;        
      }
      
      if(in_array($dni, $this->ids["persona"])) $element->logs->addLog("persona","warning","El número de documento está duplicado");
      else array_push($this->ids["persona"], $dni);
    
      if(!in_array($idComision, $this->ids["comision"])) array_push($this->ids["comision"], $element->entities["comision"]->_get("identificacion"));
      array_push($this->ids["alumno"], $idAlumno);
    }

    

  }

  public function query(){
    $this->queryEntityField("persona","numero_documento");
    $this->queryEntityField("comision","identificacion");
    $this->queryEntityField("alumno","identifier");
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

      $idComision = $element->entities["comision"]->_get("identificacion");
      $this->existElement($element, "comision", $idComision);

      $element->entities["alumno"]->_set("persona",$element->entities["persona"]->_get("id"));
      $element->entities["alumno"]->_set("comision",$element->entities["comision"]->_get("id"));
      $idAlumno = $element->entities["alumno"]->_get("identifier");
      //echo $idAlumno;
      $this->processElement($element, "alumno", $idAlumno);
    }
  }
}