<?php

require_once("class/model/Field.php");

class _FieldAlumnoCuil extends Field {

  public $type = "tinyint";
  public $fieldType = "nf";
  public $default = "0";
  public $name = "cuil";
  public $alias = "cui";
  public $entityName = "alumno";
  public $dataType = "boolean";  
  public $subtype = "checkbox";  
  public $length = "1";  


}
