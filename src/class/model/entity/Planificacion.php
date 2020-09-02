<?php

require_once("class/model/entity/_Planificacion.php");

class PlanificacionEntity extends _PlanificacionEntity {
  public function getFieldsUniqueMultiple(){ 
    return array(
      $this->container->getField("planificacion", "anio"),
      $this->container->getField("planificacion", "semestre"),
      $this->container->getField("planificacion", "plan"),
    ); 
  }

}
