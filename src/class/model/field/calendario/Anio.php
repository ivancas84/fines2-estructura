<?php

require_once("class/model/field/calendario/_Anio.php");

class FieldCalendarioAnio extends _FieldCalendarioAnio {
  public function __construct() {
    parent::__construct();
    $this->minLength = 2000;
}
}
