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
  public $id = "alumno";


  public function element($i, $data){
    /**
     * Definir elemento y asignarle los datos e indice
     * Un elemento posee todos los datos que posteriormente seran insertados y los posibles errores que puede haber
     * Existe una clase abstracta Element que posee un conjunto de metodos de uso habitual
     */
      $element = $this->container->getImportElement("comisiones_siguientes");
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
      ["sed-centro_educativo","=",$this->centroEducativo],
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
      $this->idEntityFieldCheck("comision",$element->entities["comision"]->_get("identifier"), $element);
      $this->idEntityFieldCheck("comision_anterior",$element->entities["comision_anterior"]->_get("identifier"), $element);
    }
  }

  public function query(){
    $this->queryEntityField("comision","identifier");
    $this->queryEntityField("comision","identifier","comision_anterior");
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
      $this->processElement($element, "comision", "identifier","comision_anterior");
    
    }
  }
}