<?php

require_once("class/model/Field.php");

class _FieldAsignaturaCodigo extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "codigo";
  public $alias = "cod";
  public $entityName = "asignatura";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  


}
