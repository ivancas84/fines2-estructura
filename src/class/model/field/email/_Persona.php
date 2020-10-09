<?php

require_once("class/model/Field.php");

class _FieldEmailPersona extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $length = "45";  
  public $name = "persona";
  public $alias = "per";
  public $entityName = "email";
  public $entityRefName = "persona";  


}
