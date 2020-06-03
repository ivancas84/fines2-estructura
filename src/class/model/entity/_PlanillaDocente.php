<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _PlanillaDocenteEntity extends Entity {
  public $name = "planilla_docente";
  public $alias = "pd";
 
  public function getPk(){
    return Field::getInstanceRequire("planilla_docente", "id");
  }

  public function getFieldsNf(){
    return array(
      Field::getInstanceRequire("planilla_docente", "numero"),
      Field::getInstanceRequire("planilla_docente", "insertado"),
    );
  }


}
