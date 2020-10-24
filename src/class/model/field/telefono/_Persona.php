<?php

require_once("class/model/Field.php");

class _FieldTelefonoPersona extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $name = "persona";
  public $alias = "per";
  public $entityName = "telefono";
  public $entityRefName = "persona";  
  public $dataType = "string";  
  public $subtype = "typeahead";  
  public $length = "45";  
  public $value = "string";  


}
