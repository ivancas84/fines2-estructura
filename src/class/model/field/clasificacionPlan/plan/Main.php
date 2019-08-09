<?php

require_once("class/model/Field.php");

class FieldClasificacionPlanPlanMain extends Field {

  public $type = "bigint";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "20";
  public $main = false;
  public $name = "plan";
  public $alias = "pla";


  public function getEntity(){ return new ClasificacionPlanEntity; }

  public function getEntityRef(){ return new PlanEntity; }


}
