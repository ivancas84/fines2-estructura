<?php

require_once("class/model/Field.php");

class _FieldPersonaCuil extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $length = "45";  
  public $name = "cuil";
  public $alias = "cui";
  public $entityName = "persona";


}
