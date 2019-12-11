<?php

require_once("class/model/field/comision/semestre/Main.php");

class FieldComisionSemestre extends FieldComisionSemestreMain {
  public $main = true;
  public $subtype = "select_text";
  public $selectValues = ["1","2"];
}
