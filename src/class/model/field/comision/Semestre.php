<?php

require_once("class/model/field/comision/_Semestre.php");

class FieldComisionSemestre extends _FieldComisionSemestre {
  public $main = true;
  public $subtype = "select_text";
  public $selectValues = ["1","2"];
}
