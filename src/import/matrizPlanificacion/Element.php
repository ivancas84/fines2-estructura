<?php

require_once("import/Element.php");

class MatrizPlanificacionImportElement extends ImportElement {

  public $idPlan;
  public $observaciones;
  public $updateMode = false;

  public function setEntities($row) { //@override
    $row["observaciones"] = $this->observaciones;
    $row["division"] = $this->division;

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
    
     
    $this->setDisposicion($row);
    $this->setAlumno($row);
    $this->setEntity($row, "persona", "per");
    $this->setEntity($row, "calificacion");
  }

  /**
   * @deprecated
  public function setPlanificacion($row){
    $this->entities["planificacion"] = $this->container->value("planificacion");
    $this->entities["planificacion"]->_set("identifier", 
      $this->idPlan . UNDEFINED .
      $row["pla_anio"] . UNDEFINED .
      $row["pla_semestre"]
    );
  }
   */

  public function setDisposicion($row){
    $this->entities["disposicion"] = $this->container->value("disposicion");
    $this->entities["disposicion"]->_set("identifier", 
      $this->idPlan . UNDEFINED .
      $row["pla_anio"] . UNDEFINED .
      $row["pla_semestre"] . UNDEFINED .
      $row["asi_codigo"]
    );
  }

  public function setAlumno($row){
    $this->entities["alumno"] = $this->container->value("alumno");
    $this->entities["alumno"]->_set("plan", 
      $this->idPlan
    );
    $this->entities["alumno"]->_set("identifier", 
      $row["per_numero_documento"]
    );
  }


  
}