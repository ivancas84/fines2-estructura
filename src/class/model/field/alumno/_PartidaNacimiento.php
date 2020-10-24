<?php

require_once("class/model/Field.php");

class _FieldAlumnoPartidaNacimiento extends Field {

  public $type = "tinyint";
  public $fieldType = "nf";
  public $default = "0";
  public $name = "partida_nacimiento";
  public $alias = "pn";
  public $entityName = "alumno";
  public $dataType = "boolean";  
  public $subtype = "checkbox";  
  public $length = "1";  
  public $value = "boolean";  


}
