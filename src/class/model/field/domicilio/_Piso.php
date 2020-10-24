<?php

require_once("class/model/Field.php");

class _FieldDomicilioPiso extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "piso";
  public $alias = "pis";
  public $entityName = "domicilio";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  
  public $value = "string";  


}
