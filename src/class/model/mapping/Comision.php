<?php
require_once("class/model/entityOptions/Mapping.php");

class ComisionMapping extends MappingEntityOptions{

  public function numero() {
    return "CONCAT({$this->_pf()}sed.numero, {$this->_pt()}.division, '/', COALESCE({$this->_pf()}pla.anio,''), COALESCE({$this->_pf()}pla.semestre,''))
";
  }


  public function tramo() {
    return "CONCAT(COALESCE({$this->_pf()}pla.anio,''), COALESCE({$this->_pf()}pla.semestre,''))";
  }

  public function label() {
    return $this->numero();

    return "CONCAT(
      {$this->_pf()}sed.numero, {$this->_pt()}.division,
      IF({$this->_pf()}pla.id, CONCAT({$this->_pf()}pla.anio,{$this->_pf()}pla.semestre), ''),
      IF({$this->_pf()}cal.id, CONCAT(' ',{$this->_pf()}cal.anio,'-',{$this->_pf()}cal.semestre), ''),
      IF({$this->_pf()}cal.inicio,CONCAT(' ', {$this->_pf()}cal.inicio),''),
      IF({$this->_pf()}cal.fin,CONCAT(' ', {$this->_pf()}cal.fin),'')
    )";
  }


}
