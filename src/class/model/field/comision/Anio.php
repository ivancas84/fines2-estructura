<?php

require_once("class/model/field/comision/_Anio.php");

class FieldComisionAnio extends _FieldComisionAnio {
  public $main = true;
  public $subtype = "select_text";
  public $selectValues = ["1","2","3"];
}
