<?php
require_once("class/model/entityOptions/Mapping.php");

class DisposicionMapping extends MappingEntityOptions{

  public function label() {
    return "CONCAT(
      {$this->_pf()}asi.nombre, 
      {$this->_pf()}pla.anio,
      {$this->_pf()}pla.semestre,
      {$this->_pf()}pla_plb.orientacion,
      {$this->_pf()}pla_plb.resolucion,
      {$this->_pf()}pla_plb.distribucion_horaria
    )";
  }


}
