<?php

require_once("class/model/Field.php");

class FieldSedeNumeroPad extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "numero_pad";
  public $alias = "nup";
  public $entityName = "sede";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  
  public $value = "string";  


}
