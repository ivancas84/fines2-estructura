<?php

require_once("class/import/Element.php");

class ComisionesSiguientesAlumnosImportElement extends ImportElement {

  public function setEntities($row) { //@override

    $this->setEntity($row, "alumno");
    $this->entities["alumno"]->_fastSet("id",null);
    $this->entities["alumno"]->_fastSet("comision",$row["com_comision_siguiente"]);
    $this->entities["alumno"]->_set("creado",new DateTime());

  }
  
}