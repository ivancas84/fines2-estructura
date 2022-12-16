<?php

require_once("import/Element.php");

class CalificacionImportElement extends ImportElement {

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
    

    if($this->import->fecha) $row["fecha"] = $this->import->fecha;
    
    $row["persona-numero_documento"] = preg_replace("/[^0-9\_]/", "", $row["persona-numero_documento"]);
    //se permiten numeros y guiones bajos para identificar el dni

    $row["curso"] = $this->import->curso["id"];
    $this->setEntity($row, "persona", "persona");
    $this->setEntity($row, "calificacion");
    $this->setEntity($row, "alumno");

    $this->import->cantidadEvaluados++;
    if((intval($row["nota_final"]) < 7) && intval($row["crec"]) < 4) {
      $this->import->cantidadDesaprobados++;
      $this->logs->addLog("persona", "info", "El alumno está desaprobado");
    } else {
      $this->import->cantidadAprobados++;
    }

    $this->entities["persona"]->_set("identifier", $this->entities["persona"]->_get("numero_documento"));
    $this->entities["alumno"] = $this->container->value("alumno");
    $this->entities["alumno"]->_set("identifier", $this->entities["persona"]->_get("numero_documento"));
    $this->entities["disposicion"] = $this->container->value("disposicion");
    $this->entities["disposicion"]->_set("identifier", $this->import->curso["comision-planificacion"].UNDEFINED.$this->import->curso["asignatura"]);
    $this->entities["calificacion"]->_set("identifier", 
      $this->entities["persona"]->_get("numero_documento").UNDEFINED.
      $this->import->curso["comision-planificacion"].UNDEFINED.
      $this->import->curso["asignatura"]
    );

  }
  




  
}