<?php

require_once("class/model/Field.php");

class _FieldAlumnoDocumento extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $name = "documento";
  public $alias = "doc";
  public $entityName = "alumno";
  public $entityRefName = "file";  
  public $dataType = "string";  
  public $subtype = "typeahead";  
  public $length = "45";  


}
