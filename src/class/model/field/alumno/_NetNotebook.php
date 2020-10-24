<?php

require_once("class/model/Field.php");

class _FieldAlumnoNetNotebook extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "net_notebook";
  public $alias = "nn";
  public $entityName = "alumno";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  
  public $value = "string";  


}
