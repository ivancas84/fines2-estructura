<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _PlanificacionEntity extends Entity {
  public $name = "planificacion";
  public $alias = "pla";
 
  public function getPk(){
    return Field::getInstanceRequire("planificacion", "id");
  }

  public function getFieldsNf(){
    return array(
      Field::getInstanceRequire("planificacion", "anio"),
      Field::getInstanceRequire("planificacion", "semestre"),
    );
  }

  public function getFieldsMu(){
    return array(
      Field::getInstanceRequire("planificacion", "plan"),
    );
  }


}
