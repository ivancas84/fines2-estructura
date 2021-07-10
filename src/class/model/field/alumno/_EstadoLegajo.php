<?php

require_once("class/model/Field.php");

class _FieldAlumnoEstadoLegajo extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "estado_legajo";
  public $alias = "el";
  public $entityName = "alumno";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  


}
