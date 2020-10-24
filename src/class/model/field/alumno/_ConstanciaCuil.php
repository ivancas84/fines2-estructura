<?php

require_once("class/model/Field.php");

class _FieldAlumnoConstanciaCuil extends Field {

  public $type = "tinyint";
  public $fieldType = "nf";
  public $default = "0";
  public $name = "constancia_cuil";
  public $alias = "cc";
  public $entityName = "alumno";
  public $dataType = "boolean";  
  public $subtype = "checkbox";  
  public $length = "1";  
  public $value = "boolean";  


}
