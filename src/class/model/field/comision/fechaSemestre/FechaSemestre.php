<?php

require_once("class/model/field/comision/fechaSemestre/Main.php");

class FieldComisionFechaSemestre extends FieldComisionFechaSemestreMain {
  public $notNull = true;
  public $subtype = "select_int";
  public $selectValues = array("1","2");
}
