<?php

require_once("class/model/Field.php");

class _FieldAlumnoRegion extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "region";
  public $alias = "reg";
  public $entityName = "alumno";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  


}
