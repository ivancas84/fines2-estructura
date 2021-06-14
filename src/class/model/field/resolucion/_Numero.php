<?php

require_once("class/model/Field.php");

class _FieldResolucionNumero extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "numero";
  public $alias = "num";
  public $entityName = "resolucion";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "255";  


}
