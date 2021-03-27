<?php

require_once("class/model/Field.php");

class _FieldSedeNombre extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "nombre";
  public $alias = "nom";
  public $entityName = "sede";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "255";  


}
