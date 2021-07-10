<?php

require_once("class/model/Field.php");

class _FieldCalificacionDivision extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "division";
  public $alias = "dia";
  public $entityName = "calificacion";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "255";  


}
