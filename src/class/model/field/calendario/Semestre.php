<?php

require_once("class/model/field/calendario/_Semestre.php");

class FieldCalendarioSemestre extends _FieldCalendarioSemestre {
  public $subtype = "select_text";
  public $selectValues = ["1","2"];
}
