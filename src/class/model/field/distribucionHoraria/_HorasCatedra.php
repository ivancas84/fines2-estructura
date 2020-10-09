<?php

require_once("class/model/Field.php");

class _FieldDistribucionHorariaHorasCatedra extends Field {

  public $type = "int";
  public $fieldType = "nf";
  public $default = null;
  public $length = "10";  
  public $name = "horas_catedra";
  public $alias = "hc";
  public $entityName = "distribucion_horaria";


}
