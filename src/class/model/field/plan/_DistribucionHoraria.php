<?php

require_once("class/model/Field.php");

class _FieldPlanDistribucionHoraria extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = "NULL";
  public $length = "45";
  public $main = false;
  public $name = "distribucion_horaria";
  public $alias = "dh";


  public function getEntity(){ return new PlanEntity; }


}
