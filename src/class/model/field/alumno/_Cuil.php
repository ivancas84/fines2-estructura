<?php

require_once("class/model/Field.php");

class _FieldAlumnoCuil extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "cuil";
  public $alias = "cui";
  public $entityName = "alumno";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  


}
