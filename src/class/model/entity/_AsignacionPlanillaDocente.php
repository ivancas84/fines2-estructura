<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _AsignacionPlanillaDocenteEntity extends Entity {
  public $name = "asignacion_planilla_docente";
  public $alias = "apd";
 
  public function getPk(){
    return $this->container->getField("asignacion_planilla_docente", "id");
  }

  public function getFieldsNf(){
    return array(
      $this->container->getField("asignacion_planilla_docente", "insertado"),
    );
  }

  public function getFieldsMu(){
    return array(
      $this->container->getField("asignacion_planilla_docente", "planilla_docente"),
      $this->container->getField("asignacion_planilla_docente", "toma"),
    );
  }


}
