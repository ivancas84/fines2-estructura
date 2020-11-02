<?php

require_once("class/model/Field.php");

class _FieldAlumnoLocalidad extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "localidad";
  public $alias = "loc";
  public $entityName = "alumno";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "255";  


}
