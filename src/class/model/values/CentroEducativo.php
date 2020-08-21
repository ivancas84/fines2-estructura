<?php

require_once("class/model/values/_CentroEducativo.php");

class CentroEducativo extends _CentroEducativo{

  public function numero() { return substr($this->nombre(), -2); }

}

