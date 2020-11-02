<?php

require_once("class/model/Field.php");

class _FieldComisionAlta extends Field {

  public $type = "timestamp";
  public $fieldType = "nf";
  public $default = "current_timestamp()";
  public $name = "alta";
  public $alias = "alt";
  public $entityName = "comision";
  public $dataType = "timestamp";  
  public $subtype = "timestamp";  


}
