<?php

require_once("class/model/Field.php");

class _FieldPersonaApodo extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $length = "255";  
  public $name = "apodo";
  public $alias = "apo";
  public $entityName = "persona";


}
