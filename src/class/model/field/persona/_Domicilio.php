<?php

require_once("class/model/Field.php");

class _FieldPersonaDomicilio extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $name = "domicilio";
  public $alias = "dom";
  public $entityName = "persona";
  public $entityRefName = "domicilio";  
  public $dataType = "string";  
  public $subtype = "typeahead";  
  public $length = "45";  


}
