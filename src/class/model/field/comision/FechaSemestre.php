<?php

require_once("class/model/field/comision/_FechaSemestre.php");

class FieldComisionFechaSemestre extends _FieldComisionFechaSemestre {
  public $subtype = "select_text";
  public $selectValues = ["1","2"];
}
