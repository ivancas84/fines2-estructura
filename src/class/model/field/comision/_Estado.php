<?php

require_once("class/model/Field.php");

class _FieldComisionEstado extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = "Confirma";
  public $name = "estado";
  public $alias = "est";
  public $entityName = "comision";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  


}
