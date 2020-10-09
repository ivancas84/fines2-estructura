<?php

require_once("class/model/Field.php");

class _FieldDomicilioNumero extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $length = "45";  
  public $name = "numero";
  public $alias = "num";
  public $entityName = "domicilio";


}
