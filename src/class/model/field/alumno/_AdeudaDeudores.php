<?php

require_once("class/model/Field.php");

class _FieldAlumnoAdeudaDeudores extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "adeuda_deudores";
  public $alias = "ad";
  public $entityName = "alumno";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "255";  


}
