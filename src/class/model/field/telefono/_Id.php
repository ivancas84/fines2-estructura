<?php

require_once("class/model/Field.php");

class _FieldTelefonoId extends Field {

  public $type = "varchar";
  public $fieldType = "pk";
  public $default = null;
  public $length = "45";  
  public $name = "id";
  public $alias = "id";
  public $entityName = "telefono";


}
