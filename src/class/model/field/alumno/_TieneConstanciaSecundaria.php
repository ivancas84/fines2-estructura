<?php

require_once("class/model/Field.php");

class _FieldAlumnoTieneConstanciaSecundaria extends Field {

  public $type = "tinyint";
  public $fieldType = "nf";
  public $default = "0";
  public $name = "tiene_constancia_secundaria";
  public $alias = "tcs";
  public $entityName = "alumno";
  public $dataType = "boolean";  
  public $subtype = "checkbox";  
  public $length = "1";  


}
