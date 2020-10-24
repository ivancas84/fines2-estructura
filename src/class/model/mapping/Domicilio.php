<?php
require_once("class/model/entityOptions/Mapping.php");

class DomicilioMapping extends MappingEntityOptions{

  public function label() {
    return "CONCAT_WS(' ',
      {$this->_pt()}.calle}, 
      {$this->_pt()}.entre}, 
      {$this->_pt()}.numero},
      {$this->_pt()}.barrio},
      {$this->_pt()}.localidad}
    )";
  }


}
