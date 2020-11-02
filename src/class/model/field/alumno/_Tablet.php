<?php

require_once("class/model/Field.php");

class _FieldAlumnoTablet extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "tablet";
  public $alias = "tab";
  public $entityName = "alumno";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  


}
