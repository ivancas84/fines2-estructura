<?php

require_once("class/model/Field.php");

class _FieldTelefonoInsertado extends Field {

  public $type = "timestamp";
  public $fieldType = "nf";
  public $default = "current_timestamp()";
  public $name = "insertado";
  public $alias = "ins";
  public $entityName = "telefono";
  public $dataType = "timestamp";  
  public $subtype = "timestamp";  
  public $value = "datetime";  


}
