<?php

require_once("class/model/Field.php");

class _FieldAlumnoPersona extends Field {

  public $type = "varchar";
  public $fieldType = "_u";
  public $default = null;
  public $name = "persona";
  public $alias = "per";
  public $entityName = "alumno";
  public $entityRefName = "persona";  
  public $dataType = "string";  
  public $subtype = "typeahead";  
  public $length = "45";  


}
