<?php

require_once("class/model/Field.php");

class _FieldDomicilioCalle extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "calle";
  public $alias = "cal";
  public $entityName = "domicilio";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  


}
