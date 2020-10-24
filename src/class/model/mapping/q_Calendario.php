<?php
require_once("class/model/entityOptions/Mapping.php");

class CalendarioMapping extends MappingEntityOptions{

  public function label() {
    return "CONCAT(
      {$this->_pt()}.anio,'-',{$this->_pt()}.semestre,
      IF({$this->_pt()}.inicio,CONCAT(' ', {$this->_pt()}.inicio),''),
      IF({$this->_pt()}.fin,CONCAT(' ', {$this->_pt()}.fin),'')
    )";
  }


}
