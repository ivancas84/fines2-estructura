<?php

require_once("class/model/Field.php");

class _FieldAlumnoSede extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "sede";
  public $alias = "sed";
  public $entityName = "alumno";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  
  public $value = "string";  


}
