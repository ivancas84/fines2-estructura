<?php

require_once("class/model/Entity.php");
require_once("config/entityClasses.php");

class PlanEntityMain extends Entity {
  public $name = "plan";
  public $alias = "plan";
 
  public function getPk(){
    return new FieldPlanId;
  }

  public function getFieldsNf(){
    return array(
      new FieldPlanOrientacion,
      new FieldPlanResolucion,
    );
  }


}
