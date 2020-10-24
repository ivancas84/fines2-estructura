<?php

require_once("class/model/Field.php");

class _FieldPersonaGenero extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "genero";
  public $alias = "gen";
  public $entityName = "persona";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  
  public $value = "string";  


}
