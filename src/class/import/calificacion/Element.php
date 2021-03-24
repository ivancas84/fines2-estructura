<?php

require_once("class/import/Element.php");

class CalificacionImportElement extends ImportElement {

  public function setEntities($row) { //@override
    $this->setEntity($row, "persona", "per");
    $this->setEntity($row, "calificacion");
  }
  
  
}