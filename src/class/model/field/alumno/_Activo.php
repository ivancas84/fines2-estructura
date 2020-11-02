<?php

require_once("class/model/Field.php");

class _FieldAlumnoActivo extends Field {

  public $type = "tinyint";
  public $fieldType = "nf";
  public $default = "0";
  public $name = "activo";
  public $alias = "act";
  public $entityName = "alumno";
  public $dataType = "boolean";  
  public $subtype = "checkbox";  
  public $length = "1";  


}
