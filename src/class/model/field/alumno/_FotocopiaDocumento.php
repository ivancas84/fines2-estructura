<?php

require_once("class/model/Field.php");

class _FieldAlumnoFotocopiaDocumento extends Field {

  public $type = "tinyint";
  public $fieldType = "nf";
  public $default = "0";
  public $name = "fotocopia_documento";
  public $alias = "fd";
  public $entityName = "alumno";
  public $dataType = "boolean";  
  public $subtype = "checkbox";  
  public $length = "1";  


}
