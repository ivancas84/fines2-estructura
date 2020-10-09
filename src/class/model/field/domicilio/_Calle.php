<?php

require_once("class/model/Field.php");

class _FieldDomicilioCalle extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $length = "45";  
  public $name = "calle";
  public $alias = "cal";
  public $entityName = "domicilio";


}
