<?php

require_once("class/model/Field.php");

class _FieldCalificacionNota2 extends Field {

  public $type = "decimal";
  public $fieldType = "nf";
  public $default = null;
  public $name = "nota2";
  public $alias = "nob";
  public $entityName = "calificacion";
  public $dataType = "float";  
  public $subtype = "float";  
  public $length = "4,2";  


}
