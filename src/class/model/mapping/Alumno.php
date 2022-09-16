<?php
require_once("class/model/entityOptions/Mapping.php");

class AlumnoMapping extends MappingEntityOptions{

  public function label() {
    return "CONCAT_WS(' ',
      {$this->_pf()}per.nombres, 
      {$this->_pf()}per.apellidos,
      {$this->_pf()}per.numero_documento
    )";
  }

  public function tramoIngreso() {
    return "CONCAT(COALESCE({$this->_pt()}.anio_ingreso,''), COALESCE({$this->_pt()}.semestre_ingreso,''))";
  }




}
