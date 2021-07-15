<?php

require_once("class/import/Element.php");

class CalificacionImportElement extends ImportElement {

  public $curso;

  public function setEntities($row) { //@override
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

    $this->setEntity($row, "persona", "per");
    $this->setEntity($row, "calificacion");
    $this->setEntity($row, "alumno");
    
    $this->entities["alumno"] = $this->container->getValue("alumno");
    $this->entities["alumno"]->_set("identifier", $this->entities["persona"]->_get("numero_documento"));
    $this->entities["disposicion"] = $this->container->getValue("disposicion");
    $this->entities["disposicion"]->_set("identifier", $this->import->curso["com_planificacion"].UNDEFINED.$this->import->curso["asignatura"]);
    $this->entities["calificacion"]->_set("identifier", 
      $this->entities["persona"]->_get("numero_documento").UNDEFINED.
      $this->import->curso["com_planificacion"].UNDEFINED.
      $this->import->curso["asignatura"]
    );

  }
  




  
}