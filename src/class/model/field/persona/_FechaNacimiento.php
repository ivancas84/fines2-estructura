<?php

require_once("class/model/Field.php");

class _FieldPersonaFechaNacimiento extends Field {

  public $type = "date";
  public $fieldType = "nf";
  public $default = null;
  public $length = false;  
  public $name = "fecha_nacimiento";
  public $alias = "fn";
  public $entityName = "persona";


}
