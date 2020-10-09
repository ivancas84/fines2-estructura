<?php

require_once("class/model/Field.php");

class _FieldPlanDistribucionHoraria extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $length = "45";  
  public $name = "distribucion_horaria";
  public $alias = "dh";
  public $entityName = "plan";


}
