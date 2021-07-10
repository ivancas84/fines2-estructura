<?php

require_once("class/model/Field.php");

class _FieldAlumnoEstadoInscripcion extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "estado_inscripcion";
  public $alias = "ei";
  public $entityName = "alumno";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  


}
