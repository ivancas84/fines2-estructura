<?php

require_once("class/model/Field.php");

class _FieldTelefonoPrefijo extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $length = "45";  
  public $name = "prefijo";
  public $alias = "pre";
  public $entityName = "telefono";


}
