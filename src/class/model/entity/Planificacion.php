<?php

require_once("class/model/entity/_Planificacion.php");

class PlanificacionEntity extends _PlanificacionEntity {
  public function getFieldsUniqueMultiple(){ 
    return array(
      Field::getInstanceRequire("planificacion", "anio"),
      Field::getInstanceRequire("planificacion", "semestre"),
      Field::getInstanceRequire("planificacion", "plan"),
    ); 
  }

}
