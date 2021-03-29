<?php
require_once("class/model/entityOptions/Mapping.php");

class DomicilioMapping extends MappingEntityOptions{

  public function label() {
    return "CONCAT_WS(' ',
      {$this->_pt()}.calle, 
      'e/',
      {$this->_pt()}.entre, 
      'N°',
      {$this->_pt()}.numero,      
      {$this->_pt()}.barrio,
      {$this->_pt()}.localidad
    )";
  }


}
