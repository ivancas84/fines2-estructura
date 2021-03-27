<?php

require_once("class/model/Field.php");

class _FieldComisionTurno extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "turno";
  public $alias = "tur";
  public $entityName = "comision";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  


}
