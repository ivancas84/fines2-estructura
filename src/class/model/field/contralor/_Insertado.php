<?php

require_once("class/model/Field.php");

class _FieldContralorInsertado extends Field {

  public $type = "timestamp";
  public $fieldType = "nf";
  public $default = "current_timestamp()";
  public $name = "insertado";
  public $alias = "ins";
  public $entityName = "contralor";
  public $dataType = "timestamp";  
  public $subtype = "timestamp";  


}
