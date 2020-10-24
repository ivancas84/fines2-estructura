<?php

require_once("class/model/Field.php");

class _FieldAlumnoCens extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "cens";
  public $alias = "cen";
  public $entityName = "alumno";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  
  public $value = "string";  


}
