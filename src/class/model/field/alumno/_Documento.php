<?php

require_once("class/model/Field.php");

class _FieldAlumnoDocumento extends Field {

  public $type = "tinyint";
  public $fieldType = "nf";
  public $default = "0";
  public $name = "documento";
  public $alias = "doc";
  public $entityName = "alumno";
  public $dataType = "boolean";  
  public $subtype = "checkbox";  
  public $length = "1";  


}
