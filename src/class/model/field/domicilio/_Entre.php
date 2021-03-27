<?php

require_once("class/model/Field.php");

class _FieldDomicilioEntre extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "entre";
  public $alias = "ent";
  public $entityName = "domicilio";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  


}
