<?php

require_once("class/import/Element.php");

class MatrizPlanificacionImportElement extends ImportElement {

  public $idPlan;
  public $observaciones;
  public $updateMode = false;

  public function setEntities($row) { //@override
    $row["observaciones"] = $this->observaciones;
    //Si la nota final tiene una C, debe ser considerado como crec
    if(
      strpos(
        strtolower($row["nota_final"]),
        "c"
      ) !== false
    ) {
      $row["crec"] = preg_replace("/[^0-9]/", "", $row["nota_final"]);
      $row["nota_final"] = null;
    } else {
      if(!empty($row["nota_final"])) $row["nota_final"] = preg_replace("/[^0-9]/", "", $row["nota_final"]);
      if(!empty($row["crec"])) $row["crec"] = preg_replace("/[^0-9]/", "", $row["crec"]);
    }
    
    $row["per_numero_documento"] = preg_replace("/[^0-9\_]/", "", $row["per_numero_documento"]);
    //se permiten numeros y guiones bajos para identificar el dni
    
     
    $this->setPlanificacion($row);
    $this->setEntity($row, "asignatura", "asi");
    $this->setEntity($row, "persona", "per");
    $this->setEntity($row, "calificacion");

  }

  public function setPlanificacion($row){
    $this->entities["planificacion"] = $this->container->getValue("planificacion");
    $this->entities["planificacion"]->_set("identifier", 
      $this->idPlan . UNDEFINED .
      $row["pla_anio"] . UNDEFINED .
      $row["pla_semestre"]
    );
  }
  
  
}