<?php

require_once("class/model/Field.php");

class _FieldAlumnoPartidaNacimiento extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $name = "partida_nacimiento";
  public $alias = "pn";
  public $entityName = "alumno";
  public $entityRefName = "file";  
  public $dataType = "string";  
  public $subtype = "typeahead";  
  public $length = "45";  


}
