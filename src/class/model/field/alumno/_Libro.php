<?php

require_once("class/model/Field.php");

class _FieldAlumnoLibro extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "libro";
  public $alias = "lib";
  public $entityName = "alumno";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  


}
