<?php

require_once("class/model/Field.php");

class _FieldDistribucionHorariaDia extends Field {

  public $type = "int";
  public $fieldType = "nf";
  public $default = null;
  public $length = "10";  
  public $name = "dia";
  public $alias = "dia";
  public $entityName = "distribucion_horaria";


}
