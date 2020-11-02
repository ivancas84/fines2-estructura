<?php

require_once("class/model/Field.php");

class _FieldAlumnoTelefonoCelular extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "telefono_celular";
  public $alias = "tc";
  public $entityName = "alumno";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  


}
