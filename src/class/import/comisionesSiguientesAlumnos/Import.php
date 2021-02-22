<?php

require_once("class/import/Import.php");
require_once("class/model/Db.php");
require_once("function/array_combine_key.php");

class ComisionesSiguientesAlumnosImport extends Import{

  /**
   * Definir
   */
  public $idCalendario = null;
  public $anio = "2021";
  public $semestre = "1";
  public $modalidad = "1";


  public $mode = "db";
  public $id = "comisiones_siguientes_alumnos";

  
  public function initialize(){
    $this->container->getEntity("alumno")->identifier = ["persona","comision"]; 

  }

  public function element($i, $data){
    /**
     * Definir elemento y asignarle los datos e indice
     * Un elemento posee todos los datos que posteriormente seran insertados y los posibles errores que puede haber
     * Existe una clase abstracta Element que posee un conjunto de metodos de uso habitual
     */
      $element = $this->container->getImportElement($this->entityName);
      $element->index = $i;
      $element->idCalendario = $this->idCalendario;
      $element->setEntities($data);
      array_push($this->elements, $element);
    }

  
  public function defineSource(){
    $render = $this->container->getRender("comision");
    $render->setCondition([
      ["cal-anio","=",$this->anio],
      ["cal-semestre","=",$this->semestre],
      ["modalidad","=",$this->modalidad],
    ]);
    $render->setSize(0);
    $comisionesActuales = array_combine_key($this->container->getDb()->all("comision", $render), "id");
    
    $render = $this->container->getRender("alumno");
    $render->setSize(0);

    $render->setCondition(["com-comision_siguiente","=",array_keys($comisionesActuales)]);
    $sql = $this->container->getSqlo("alumno")->select($render);
    $this->source = $this->container->getDb()->all("alumno",$render);
  }

  public function identify(){
    $this->ids["alumno"] = [];
    foreach($this->elements as &$element){
      $idAlumno = $element->entities["alumno"]->_get("persona"). UNDEFINED. $element->entities["alumno"]->_get("comision");

      if(in_array($idAlumno, $this->ids["alumno"])) {
        $element->process = false;                
        $element->logs->addLog("alumno", "error", "El identificador de alumno ya se encuentra definido");
        continue;
      }

      $element->entities["alumno"]->_set("identifier",$idAlumno);
      array_push($this->ids["alumno"], $idAlumno);
    }
  }

  public function query(){
    $this->queryEntityField("alumno","identifier");
  }

  public function process(){    
    foreach($this->elements as &$element) {
      if(!$element->process) continue;

      $idAlumno = $element->entities["alumno"]->_get("identifier");
      if(array_key_exists($idAlumno, $this->dbs["alumno"])) {
        $element->logs->addLog("alumno","error","Ya existe el alumno");
        $element->process = false;
        continue;
      }

      $this->processElement($element, "alumno", $idAlumno);

    }
  }
}