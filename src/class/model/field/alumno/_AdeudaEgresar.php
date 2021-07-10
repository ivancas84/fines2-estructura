<?php

require_once("class/model/Field.php");

class _FieldAlumnoAdeudaEgresar extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "adeuda_egresar";
  public $alias = "ae";
  public $entityName = "alumno";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "255";  


}
