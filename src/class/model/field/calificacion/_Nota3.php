<?php

require_once("class/model/Field.php");

class _FieldCalificacionNota3 extends Field {

  public $type = "decimal";
  public $fieldType = "nf";
  public $default = null;
  public $name = "nota3";
  public $alias = "noc";
  public $entityName = "calificacion";
  public $dataType = "float";  
  public $subtype = "float";  
  public $length = "4,2";  


}
