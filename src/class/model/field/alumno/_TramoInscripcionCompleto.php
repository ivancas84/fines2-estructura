<?php

require_once("class/model/Field.php");

class _FieldAlumnoTramoInscripcionCompleto extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "tramo_inscripcion_completo";
  public $alias = "tic";
  public $entityName = "alumno";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  


}
