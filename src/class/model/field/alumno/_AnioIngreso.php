<?php

require_once("class/model/Field.php");

class _FieldAlumnoAnioIngreso extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "anio_ingreso";
  public $alias = "ai";
  public $entityName = "alumno";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  


}
