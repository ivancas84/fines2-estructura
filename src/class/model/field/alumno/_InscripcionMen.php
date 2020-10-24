<?php

require_once("class/model/Field.php");

class _FieldAlumnoInscripcionMen extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "inscripcion_men";
  public $alias = "im";
  public $entityName = "alumno";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  
  public $value = "string";  


}
