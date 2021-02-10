<?php

require_once("class/import/Element.php");

class Alumno2ImportElement extends ImportElement {

  public function setEntities($row) { //@override
    $this->setEntity($row, "persona", "per");
    //$this->setEntity($row, "comision", "com");
    //$this->setEntity($row, "alumno");


  }
  
  
}