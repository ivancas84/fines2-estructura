<?php

require_once("class/model/Field.php");

class _FieldAlumnoDistrito extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "distrito";
  public $alias = "dis";
  public $entityName = "alumno";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "255";  
  public $value = "string";  


}
