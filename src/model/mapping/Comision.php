<?php
require_once("model/entityOptions/Mapping.php");

class ComisionMapping extends MappingEntityOptions{

  public function numero() {
    return "CONCAT({$this->_pf()}sede.numero, {$this->_pt()}.division, '/', COALESCE({$this->_pf()}planificacion.anio,''), COALESCE({$this->_pf()}planificacion.semestre,''))
";
  }


  public function tramo() {
    return "CONCAT(COALESCE({$this->_pf()}planificacion.anio,''), COALESCE({$this->_pf()}planificacion.semestre,''))";
  }

  public function label() {
    return "CONCAT(
      {$this->_pf()}sede.numero, {$this->_pt()}.division,
      IF({$this->_pf()}planificacion.id, CONCAT('/',{$this->_pf()}planificacion.anio,{$this->_pf()}planificacion.semestre), ''),
      IF({$this->_pf()}calendario.id, CONCAT(' ',{$this->_pf()}calendario.anio,'-',{$this->_pf()}calendario.semestre), '')
    )";
  }


}
