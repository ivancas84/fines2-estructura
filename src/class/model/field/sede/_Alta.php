<?php

require_once("class/model/Field.php");

class _FieldSedeAlta extends Field {

  public $type = "timestamp";
  public $fieldType = "nf";
  public $default = "current_timestamp()";
  public $name = "alta";
  public $alias = "alt";
  public $entityName = "sede";
  public $dataType = "timestamp";  
  public $subtype = "timestamp";  


}
