<?php

require_once("class/model/Field.php");

class _FieldDistribucionHorariaDia extends Field {

  public $type = "int";
  public $fieldType = "nf";
  public $default = null;
  public $name = "dia";
  public $alias = "dia";
  public $entityName = "distribucion_horaria";
  public $dataType = "integer";  
  public $subtype = "integer";  
  public $length = "10";  


}
