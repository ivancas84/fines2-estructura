<?php

require_once("class/model/Field.php");

class _FieldTomaTipoMovimiento extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "tipo_movimiento";
  public $alias = "tm";
  public $entityName = "toma";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  
  public $value = "string";  


}
