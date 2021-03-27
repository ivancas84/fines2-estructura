<?php

require_once("class/model/Field.php");

class _FieldDistribucionHorariaHorasCatedra extends Field {

  public $type = "int";
  public $fieldType = "nf";
  public $default = null;
  public $name = "horas_catedra";
  public $alias = "hc";
  public $entityName = "distribucion_horaria";
  public $dataType = "integer";  
  public $subtype = "integer";  
  public $length = "10";  


}
