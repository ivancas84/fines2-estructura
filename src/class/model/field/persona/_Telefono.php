<?php

require_once("class/model/Field.php");

class _FieldPersonaTelefono extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $length = "255";  
  public $name = "telefono";
  public $alias = "tel";
  public $entityName = "persona";


}
