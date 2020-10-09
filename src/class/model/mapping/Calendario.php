<?php
require_once("class/model/mapping/_Calendario.php");

class CalendarioMapping extends _CalendarioMapping{

  public function label() {
    return "CONCAT(
      {$this->_pt()}.anio,'-',{$this->_pt()}.semestre,
      IF({$this->_pt()}.inicio,CONCAT(' ', {$this->_pt()}.inicio),''),
      IF({$this->_pt()}.fin,CONCAT(' ', {$this->_pt()}.fin),'')
    )";
  }


}
