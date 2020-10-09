<?php
require_once("class/model/mapping/_Comision.php");

class ComisionMapping extends _ComisionMapping{

  public function tramo() {
    return "CONCAT(COALESCE({$this->_pt()}pla.anio,''), COALESCE({$this->_pt()}pla.semestre,''))";
  }

  public function label() {
    return "CONCAT(
      {$this->_pt()}sed.numero, {$this->_pt()}.division,
      IF({$this->_pt()}pla.id, CONCAT({$this->_pt()}pla.anio,{$this->_pt()}pla.semestre), ''),
      IF({$this->_pt()}cal.id, CONCAT(' ',{$this->_pt()}cal.anio,'-',{$this->_pt()}cal.semestre), ''),
      IF({$this->_pt()}cal.inicio,CONCAT(' ', {$this->_pt()}cal.inicio),''),
      IF({$this->_pt()}cal.fin,CONCAT(' ', {$this->_pt()}cal.fin),'')
    )";
  }


}
