<?php

require_once("class/model/Field.php");

class _FieldAlumnoTieneDeclaracionJurada extends Field {

  public $type = "tinyint";
  public $fieldType = "nf";
  public $default = "0";
  public $name = "tiene_declaracion_jurada";
  public $alias = "tdj";
  public $entityName = "alumno";
  public $dataType = "boolean";  
  public $subtype = "checkbox";  
  public $length = "1";  


}
