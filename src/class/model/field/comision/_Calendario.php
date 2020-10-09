<?php

require_once("class/model/Field.php");

class _FieldComisionCalendario extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $length = "45";  
  public $name = "calendario";
  public $alias = "cal";
  public $entityName = "comision";
  public $entityRefName = "calendario";  


}
