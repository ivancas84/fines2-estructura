<?php

require_once("class/model/Field.php");

class _FieldTelefonoPrefijo extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "prefijo";
  public $alias = "pre";
  public $entityName = "telefono";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  
  public $value = "string";  


}
