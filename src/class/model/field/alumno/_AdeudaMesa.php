<?php

require_once("class/model/Field.php");

class _FieldAlumnoAdeudaMesa extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "adeuda_mesa";
  public $alias = "am";
  public $entityName = "alumno";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "255";  


}
