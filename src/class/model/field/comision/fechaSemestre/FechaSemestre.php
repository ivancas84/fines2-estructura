<?php

require_once("class/model/field/comision/fechaSemestre/Main.php");

class FieldComisionFechaSemestre extends FieldComisionFechaSemestreMain {
  public $subtype = "select_text";
  public $selectValues = ["1","2"];
}
