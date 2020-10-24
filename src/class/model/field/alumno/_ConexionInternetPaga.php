<?php

require_once("class/model/Field.php");

class _FieldAlumnoConexionInternetPaga extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "conexion_internet_paga";
  public $alias = "cip";
  public $entityName = "alumno";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  
  public $value = "string";  


}
