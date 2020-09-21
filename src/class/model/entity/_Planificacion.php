<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _PlanificacionEntity extends Entity {
  public $name = "planificacion";
  public $alias = "pla";
 
  public function getPk(){
    return $this->container->getField("planificacion", "id");
  }

  public function getFieldsNf(){
    return array(
      $this->container->getField("planificacion", "anio"),
      $this->container->getField("planificacion", "semestre"),
    );
  }

  public function getFieldsMu(){
    return array(
      $this->container->getField("planificacion", "plan"),
    );
  }


}
