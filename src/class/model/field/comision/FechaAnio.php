<?php

require_once("class/model/field/comision/_FechaAnio.php");

class FieldComisionFechaAnio extends _FieldComisionFechaAnio {
  public function __construct() {
    parent::__construct();
    $this->minLength = 2000;
}
}
