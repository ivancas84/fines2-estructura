<?php

require_once("class/model/Field.php");

class _FieldAlumnoSemestreIngreso extends Field {

  public $type = "smallint";
  public $fieldType = "nf";
  public $default = null;
  public $name = "semestre_ingreso";
  public $alias = "sia";
  public $entityName = "alumno";
  public $dataType = "integer";  
  public $subtype = "integer";  
  public $length = "1";  


}
