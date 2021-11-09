<?php

require_once("class/model/Field.php");

class _FieldAlumnoEstablecimientoInscripcion extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "establecimiento_inscripcion";
  public $alias = "eia";
  public $entityName = "alumno";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "255";  


}
