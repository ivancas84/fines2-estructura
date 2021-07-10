<?php

require_once("class/model/Field.php");

class _FieldAlumnoLegajoCompleto extends Field {

  public $type = "tinyint";
  public $fieldType = "nf";
  public $default = "0";
  public $name = "legajo_completo";
  public $alias = "lc";
  public $entityName = "alumno";
  public $dataType = "boolean";  
  public $subtype = "checkbox";  
  public $length = "1";  


}
