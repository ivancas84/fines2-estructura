<?php

require_once("class/import/Element.php");

class ComisionesSiguientesImportElement extends ImportElement {

  public function setEntities($row) { //@override

    $this->setEntity($row, "comision");
    $this->entities["comision"]->_fastSet("identifier",$row["identifier"]);
    $this->entities["comision"]->_fastSet("id",null);
    $this->entities["comision"]->_fastSet("apertura",false);
    $this->entities["comision"]->_fastSet("alta",new DateTime());
    $this->entities["comision"]->_fastSet("calendario",$this->idCalendario);
    $this->entities["comision"]->_fastSet(
      "planificacion",
      $this->entities["comision"]->planificacionSiguiente()
    );
    $this->entities["comision"]->_fastSet("identifier", $row["sed_numero"].UNDEFINED.$row["division"].UNDEFINED.$this->entities["comision"]->_get("planificacion"));

    if(Validation::is_empty($this->entities["comision"]->_get("planificacion"))) {
      $this->process = false;
      $this->logs->addLog("comision", "error", "Planificacion vacia");                
    }

    $this->setEntity($row, "comision", "", "comision_anterior");
    $this->entities["comision_anterior"]->_fastSet("identifier", $row["identifier"]);

  }
  
}