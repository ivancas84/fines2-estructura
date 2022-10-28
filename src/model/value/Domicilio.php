<?php
require_once("class/model/entityOptions/Value.php");

class DomicilioValue extends ValueEntityOptions{

  public function getLabel() {
    return $this->_get("calle") . " e/ " . $this->_get("entre") . " n° ". $this->_get("numero") . " " . $this->_get("barrio") . " " . $this->_get("localidad");
  }


}
