<?php
require_once("model/entityOptions/Mapping.php");

class SedeMapping extends MappingEntityOptions{

  public function numero_trim() { return "TRIM(LEADING 0 FROM {$this->_pt()}.numero)"; }
  public function numero_pad() { return "LPAD({$this->_pt()}.numero, 3, 0)"; }
  
}
