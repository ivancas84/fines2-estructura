<?php

require_once("class/model/Field.php");

class _FieldResolucionTipo extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "tipo";
  public $alias = "tip";
  public $entityName = "resolucion";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "255";  


}
