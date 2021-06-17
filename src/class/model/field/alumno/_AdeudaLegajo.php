<?php

require_once("class/model/Field.php");

class _FieldAlumnoAdeudaLegajo extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "adeuda_legajo";
  public $alias = "al";
  public $entityName = "alumno";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "255";  


}
