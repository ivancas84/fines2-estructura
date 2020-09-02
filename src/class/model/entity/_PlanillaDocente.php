<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _PlanillaDocenteEntity extends Entity {
  public $name = "planilla_docente";
  public $alias = "pd";
 
  public function getPk(){
    return $this->container->getField("planilla_docente", "id");
  }

  public function getFieldsNf(){
    return array(
      $this->container->getField("planilla_docente", "numero"),
      $this->container->getField("planilla_docente", "insertado"),
    );
  }


}
