<?php

require_once("class/import/Import.php");
require_once("class/model/Db.php");

class ComisionesSiguientesImport extends Import{

  /**
   * Definir
   */
  public $idCalendario = null;
  public $anio = "2020";
  public $semestre = "2";
  public $modalidad = "1";


  public $mode = "db";
  public $id = "alumno";


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
      
  public function initialize(){
    $this->container->getEntity("comision")->identifier = ["sed-numero","division", "planificacion"]; 

  }
  
  public function defineSource(){
    $render = $this->container->getRender("comision");
    $render->setCondition([
      ["autorizada","=",true],
      ["cal-anio","=",$this->anio],
      ["cal-semestre","=",$this->semestre],
      ["modalidad","=",$this->modalidad],
      ["tramo", "!=","32"]
    ]);

    $fields = $this->container->getRel("comision")->fieldNames();
    array_push($fields, "identifier");
    $render->setFields($fields);

    $this->source = $this->container->getDb()->select("comision", $render);
  }

  public function identify(){
    $this->ids["comision"] = [];
    $this->ids["comision_anterior"] = [];
    foreach($this->elements as &$element){
      $idComision = $element->entities["comision"]->_get("identifier");
      if(Validation::is_empty($idComision)){
        $element->process = false;                
        $element->logs->addLog("comision", "error", "El identificador de comision esta vacio para " . $element->entities["comision_anterior"]->_get("id") );
        continue;  
      }

      if(in_array($idComision, $this->ids["comision"])) {
        $element->process = false;                
        $element->logs->addLog("comision", "error", "El identificador de comision ya se encuentra definido");
        continue;
      }

      array_push($this->ids["comision"], $idComision);

      $idComision = $element->entities["comision_anterior"]->_get("identifier");
      if(Validation::is_empty($idComision)){
        $element->process = false;                
        $element->logs->addLog("comision_anterior", "error", "El identificador de comision esta vacio para " . $element->entities["comision_anterior"]->_get("id"));
        continue;  
      }
      if(in_array($idComision, $this->ids["comision_anterior"])) {
        $element->process = false;                
        $element->logs->addLog("comision_anterior", "error", "El identificador de comision ya se encuentra definido");
        continue;
      }
      
      array_push($this->ids["comision_anterior"], $idComision);
    }
  }

  public function query(){
    $this->queryEntityField("comision","identifier");
    $this->queryEntityField("comision","identifier","comision_anterior");
  }

  public function process(){    
    foreach($this->elements as &$element) {
      if(!$element->process) continue;

      $idComision = $element->entities["comision"]->_get("identifier");
      if(array_key_exists($idComision, $this->dbs["comision"])) {
        $element->logs->addLog("comision","error","Ya existe la comision siguiente");
        $element->process = false;
        continue;
      }

      $this->processElement($element, "comision", $idComision);

      $id = $element->entities["comision"]->_get("id");
      $element->entities["comision_anterior"]->_set("comision_siguiente",$id);
      $idComision = $element->entities["comision_anterior"]->_get("identifier");
      $this->processElement($element, "comision", $idComision,"comision_anterior");
    
    }
  }
}