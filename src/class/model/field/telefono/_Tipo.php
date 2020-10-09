<?php

require_once("class/model/Field.php");

class _FieldTelefonoTipo extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $length = "45";  
  public $name = "tipo";
  public $alias = "tip";
  public $entityName = "telefono";


}
