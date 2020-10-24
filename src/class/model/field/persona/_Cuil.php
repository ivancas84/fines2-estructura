<?php

require_once("class/model/Field.php");

class _FieldPersonaCuil extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "cuil";
  public $alias = "cui";
  public $entityName = "persona";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  
  public $value = "string";  


}
