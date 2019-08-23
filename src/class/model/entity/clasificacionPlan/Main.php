<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class ClasificacionPlanEntityMain extends Entity {
  public $name = "clasificacion_plan";
  public $alias = "cp";
 
  public function getPk(){
    return Field::getInstanceRequire("clasificacion_plan", "id");
  }

  public function getFieldsNf(){
    return array(
    );
  }

  public function getFieldsMu(){
    return array(
      Field::getInstanceRequire("clasificacion_plan", "clasificacion"),
      Field::getInstanceRequire("clasificacion_plan", "plan"),
    );
  }


}
