<?php

require_once("class/model/Field.php");

class _FieldCalificacionNotaFinal extends Field {

  public $type = "decimal";
  public $fieldType = "nf";
  public $default = null;
  public $name = "nota_final";
  public $alias = "nf";
  public $entityName = "calificacion";
  public $dataType = "float";  
  public $subtype = "float";  
  public $length = "4,2";  


}
