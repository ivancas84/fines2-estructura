<?php

require_once("class/model/field/comision/anio/Main.php");

class FieldComisionAnio extends FieldComisionAnioMain {
  public $main = true;
  public $subtype = "select_text";
  public $selectValues = ["1","2","3"];
}
