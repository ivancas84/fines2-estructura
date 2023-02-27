<?php
require_once("model/entityOptions/Mapping.php");

class AlumnoMapping extends MappingEntityOptions{

  public function label() {
    return "CONCAT_WS(' ',
      {$this->_pf()}persona.nombres, 
      {$this->_pf()}persona.apellidos,
      {$this->_pf()}persona.numero_documento
    )";
  }

  public function tramo_ingreso() {
    return "CONCAT(COALESCE({$this->_pt()}.anio_ingreso,''), COALESCE({$this->_pt()}.semestre_ingreso,''))";
  }




}
