<?php

require_once("class/model/Field.php");

class _FieldAlumnoTieneConstanciaPrimaria extends Field {

  public $type = "tinyint";
  public $fieldType = "nf";
  public $default = "0";
  public $name = "tiene_constancia_primaria";
  public $alias = "tcp";
  public $entityName = "alumno";
  public $dataType = "boolean";  
  public $subtype = "checkbox";  
  public $length = "1";  


}
