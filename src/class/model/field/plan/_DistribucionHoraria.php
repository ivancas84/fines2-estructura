<?php

require_once("class/model/Field.php");

class _FieldPlanDistribucionHoraria extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "distribucion_horaria";
  public $alias = "dh";
  public $entityName = "plan";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  
  public $value = "string";  


}
