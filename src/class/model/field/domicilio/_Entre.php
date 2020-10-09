<?php

require_once("class/model/Field.php");

class _FieldDomicilioEntre extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $length = "45";  
  public $name = "entre";
  public $alias = "ent";
  public $entityName = "domicilio";


}
