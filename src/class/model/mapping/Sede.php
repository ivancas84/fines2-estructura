<?php
require_once("class/model/mapping/_Sede.php");

class SedeMapping extends _SedeMapping{

  public function numeroTrim() { return "TRIM(LEADING 0 FROM {$this->_pt()}.numero)"; }
  
}
