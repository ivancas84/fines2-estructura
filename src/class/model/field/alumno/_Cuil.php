<?php

require_once("class/model/Field.php");

class _FieldAlumnoCuil extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $name = "cuil";
  public $alias = "cui";
  public $entityName = "alumno";
  public $entityRefName = "file";  
  public $dataType = "string";  
  public $subtype = "typeahead";  
  public $length = "45";  


}
