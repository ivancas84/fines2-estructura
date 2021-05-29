<?php

require_once("class/model/Field.php");

class _FieldCalificacionAlumno extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $name = "alumno";
  public $alias = "alu";
  public $entityName = "calificacion";
  public $entityRefName = "alumno";  
  public $dataType = "string";  
  public $subtype = "typeahead";  
  public $length = "45";  


}
