<?php

require_once("class/model/Field.php");

class _FieldAlumnoPlan extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $name = "plan";
  public $alias = "pla";
  public $entityName = "alumno";
  public $entityRefName = "plan";  
  public $dataType = "string";  
  public $subtype = "typeahead";  
  public $length = "45";  


}
