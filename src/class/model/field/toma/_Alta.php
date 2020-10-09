<?php

require_once("class/model/Field.php");

class _FieldTomaAlta extends Field {

  public $type = "timestamp";
  public $fieldType = "nf";
  public $default = "current_timestamp()";
  public $length = false;  
  public $name = "alta";
  public $alias = "alt";
  public $entityName = "toma";


}
