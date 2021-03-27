<?php

require_once("class/import/Element.php");

class AlumnoImportElement extends ImportElement {

  public function setEntities($row) { //@override
    $this->setEntity($row, "persona");
    $this->setEntity($row, "comision", "com");
    $this->setEntity($row, "alumno", "alu");
    $this->entities["alumno"]->_set("anio_ingreso", preg_replace("/[^0-9]/", "", $this->entities["alumno"]->_get("anio_ingreso")));
  }
  
  
}