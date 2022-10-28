<?php
require_once("model/entityOptions/Mapping.php");

class PlanificacionMapping extends MappingEntityOptions{

  public function tramo() {
    return "CONCAT(COALESCE({$this->_pt()}.anio,''), COALESCE({$this->_pt()}.semestre,''))";
  }



}
