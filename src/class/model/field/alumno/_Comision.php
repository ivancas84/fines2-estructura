<?php

require_once("class/model/Field.php");

class _FieldAlumnoComision extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $name = "comision";
  public $alias = "com";
  public $entityName = "alumno";
  public $entityRefName = "comision";  
  public $dataType = "string";  
  public $subtype = "typeahead";  
  public $length = "45";  
  public $value = "string";  


}
