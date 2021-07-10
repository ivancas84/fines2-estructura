<?php

require_once("class/model/Field.php");

class _FieldAlumnoTieneDni extends Field {

  public $type = "tinyint";
  public $fieldType = "nf";
  public $default = "0";
  public $name = "tiene_dni";
  public $alias = "td";
  public $entityName = "alumno";
  public $dataType = "boolean";  
  public $subtype = "checkbox";  
  public $length = "1";  


}
