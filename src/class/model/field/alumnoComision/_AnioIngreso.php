<?php

require_once("class/model/Field.php");

class _FieldAlumnoComisionAnioIngreso extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "anio_ingreso";
  public $alias = "ai";
  public $entityName = "alumno_comision";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  


}
