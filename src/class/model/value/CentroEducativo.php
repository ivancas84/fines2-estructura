<?php

require_once("class/model/value/_CentroEducativo.php");

class CentroEducativoValue extends _CentroEducativoValue{

  public function numero() { return substr($this->nombre(), -2); }

}

