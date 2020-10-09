<?php

require_once("class/model/Field.php");

class _FieldSedeDomicilio extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $length = "45";  
  public $name = "domicilio";
  public $alias = "dom";
  public $entityName = "sede";
  public $entityRefName = "domicilio";  


}
