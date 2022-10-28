<?php

require_once("class/import/Import.php");
require_once("class/model/Db.php");

class ComisionesSiguientesImport extends Import{
  /**
   * comision: comisiones a definir
   * comision_anterior: comisiones a actualizar
   */

  public $idCalendario = null;
  public $anio;
  public $semestre;
  public $modalidad;
  public $centroEducativo;

  public $mode = "db";
  public $id = "comisiones_siguientes";


  public function initialize(){
    $this->container->getEntity("comision")->identifier = ["sede-numero","division", "planificacion"]; 
  }
  
  public function defineSource(){
    $render = $this->container->getEntityRender("comision");
    $render->setCondition([
      ["autorizada","=",true],
      ["calendario-anio","=",$this->anio],
      ["calendario-semestre","=",$this->semestre],
      ["modalidad","=",$this->modalidad],
      ["sede-centro_educativo","=",$this->centroEducativo],
      ["tramo", "!=","32"]
    ]);

    $fields = $this->container->tools("comision")->fieldNames();
    array_push($fields, "identifier");
    $render->setFields($fields);

    $this->source = $this->container->getDb()->select("comision", $render);
  }

  public function identify(){
    foreach($this->elements as &$element){
      $this->idEntityFieldCheck("comision",$element->entities["comision"]->_get("identifier"), $element);
      $this->idEntityFieldCheck("comision_anterior",$element->entities["comision_anterior"]->_get("identifier"), $element);
    }
  }

  public function query(){
    $this->queryEntity("comision","identifier");
    $this->queryEntity("comision","identifier","comision_anterior");
  }

  public function process(){    
    foreach($this->elements as &$element) {
      if(!$element->process) continue;

      if(!$this->insertElement($element,"comision")){
        $element->process = false;
        continue;
      };

      $id = $element->entities["comision"]->_get("id");
      $element->entities["comision_anterior"]->_set("comision_siguiente",$id);
      $this->processElement($element, "comision", "identifier",true, "comision_anterior");
    
    }
  }
}