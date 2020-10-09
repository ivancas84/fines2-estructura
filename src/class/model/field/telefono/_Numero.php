<?php

require_once("class/model/Field.php");

class _FieldTelefonoNumero extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $length = "255";  
  public $name = "numero";
  public $alias = "num";
  public $entityName = "telefono";


}
