<?php

require_once("class/model/field/alumno/_AnioIngreso.php");

class FieldAlumnoAnioIngreso extends _FieldAlumnoAnioIngreso {
  public $subtype = "select";
  public $selectValues = ["1","2","3"];

}
