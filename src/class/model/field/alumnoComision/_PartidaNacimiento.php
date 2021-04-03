<?php

require_once("class/model/Field.php");

class _FieldAlumnoComisionPartidaNacimiento extends Field {

  public $type = "tinyint";
  public $fieldType = "nf";
  public $default = "0";
  public $name = "partida_nacimiento";
  public $alias = "pn";
  public $entityName = "alumno_comision";
  public $dataType = "boolean";  
  public $subtype = "checkbox";  
  public $length = "1";  


}
