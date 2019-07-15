<?php

require_once("class/model/Entity.php");
require_once("config/entityClasses.php");

class ClasificacionPlanEntityMain extends Entity {
  public $name = "clasificacion_plan";
  public $alias = "cp";
 
  public function getPk(){
    return new FieldClasificacionPlanId;
  }

  public function getFieldsNf(){
    return array(
    );
  }

  public function getFieldsMu(){
    return array(
      new FieldClasificacionPlanClasificacion,
      new FieldClasificacionPlanPlan,
    );
  }


}
