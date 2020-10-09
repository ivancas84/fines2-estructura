<?php

require_once("class/model/Field.php");

class _FieldDomicilioPiso extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $length = "45";  
  public $name = "piso";
  public $alias = "pis";
  public $entityName = "domicilio";


}
