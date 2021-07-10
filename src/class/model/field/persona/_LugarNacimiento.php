<?php

require_once("class/model/Field.php");

class _FieldPersonaLugarNacimiento extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "lugar_nacimiento";
  public $alias = "ln";
  public $entityName = "persona";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "255";  


}
