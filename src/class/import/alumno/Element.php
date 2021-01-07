<?php

require_once("class/import/Element.php");

class AlumnoImportElement extends ImportElement {

  public function setEntities($row) { //@override
    $this->setEntity($row, "persona");
    $this->setEntity($row, "comision", "com");
    $this->setEntity($row, "alumno", "vacio");


  }
  
  
}