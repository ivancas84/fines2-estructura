<?php

require_once("class/model/Field.php");

class _FieldComisionConfiguracion extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = "Histórica";
  public $name = "configuracion";
  public $alias = "con";
  public $entityName = "comision";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  


}
