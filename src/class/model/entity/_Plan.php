<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _PlanEntity extends Entity {
  public $name = "plan";
  public $alias = "plan";
 
  public function getPk(){
    return Field::getInstanceRequire("plan", "id");
  }

  public function getFieldsNf(){
    return array(
      Field::getInstanceRequire("plan", "orientacion"),
      Field::getInstanceRequire("plan", "resolucion"),
      Field::getInstanceRequire("plan", "distribucion_horaria"),
    );
  }


}
