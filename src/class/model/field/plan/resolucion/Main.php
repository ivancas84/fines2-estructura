<?php

require_once("class/model/Field.php");

class FieldPlanResolucionMain extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = "255";
  public $main = false;
  public $name = "resolucion";
  public $alias = "res";


  public function getEntity(){ return new PlanEntity; }


}
