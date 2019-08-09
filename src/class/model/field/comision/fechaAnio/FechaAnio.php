<?php

require_once("class/model/field/comision/fechaAnio/Main.php");

class FieldComisionFechaAnio extends FieldComisionFechaAnioMain {
  public $notNull = true;
  public $subtype = "select_text";
  public $selectValues = array("2019","2018","2017","2016");
}
