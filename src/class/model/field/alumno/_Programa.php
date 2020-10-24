<?php

require_once("class/model/Field.php");

class _FieldAlumnoPrograma extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "programa";
  public $alias = "pro";
  public $entityName = "alumno";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "255";  
  public $value = "string";  


}
