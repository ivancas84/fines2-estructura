<?php

require_once("class/model/Field.php");

class _FieldDomicilioDepartamento extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "departamento";
  public $alias = "dep";
  public $entityName = "domicilio";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  
  public $value = "string";  


}
