<?php

require_once("class/model/Field.php");

class _FieldPersonaDomicilio extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $length = "45";  
  public $name = "domicilio";
  public $alias = "dom";
  public $entityName = "persona";
  public $entityRefName = "domicilio";  


}
