<?php

require_once("class/model/Field.php");

class _FieldCalificacionNota1 extends Field {

  public $type = "decimal";
  public $fieldType = "nf";
  public $default = null;
  public $name = "nota1";
  public $alias = "noa";
  public $entityName = "calificacion";
  public $dataType = "float";  
  public $subtype = "float";  
  public $length = "4,2";  


}
