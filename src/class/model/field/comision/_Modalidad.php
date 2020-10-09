<?php

require_once("class/model/Field.php");

class _FieldComisionModalidad extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $length = "45";  
  public $name = "modalidad";
  public $alias = "moa";
  public $entityName = "comision";
  public $entityRefName = "modalidad";  


}
