<?php

require_once("class/model/Field.php");

class _FieldComisionId extends Field {

  public $type = "varchar";
  public $fieldType = "pk";
  public $default = null;
  public $name = "id";
  public $alias = "id";
  public $entityName = "comision";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  


}
