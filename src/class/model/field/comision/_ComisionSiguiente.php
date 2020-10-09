<?php

require_once("class/model/Field.php");

class _FieldComisionComisionSiguiente extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $length = "45";  
  public $name = "comision_siguiente";
  public $alias = "cs";
  public $entityName = "comision";
  public $entityRefName = "comision";  


}
