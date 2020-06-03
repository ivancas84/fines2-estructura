<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _DistribucionHorariaEntity extends Entity {
  public $name = "distribucion_horaria";
  public $alias = "dh";
 
  public function getPk(){
    return Field::getInstanceRequire("distribucion_horaria", "id");
  }

  public function getFieldsNf(){
    return array(
      Field::getInstanceRequire("distribucion_horaria", "horas_catedra"),
      Field::getInstanceRequire("distribucion_horaria", "dia"),
    );
  }

  public function getFieldsMu(){
    return array(
      Field::getInstanceRequire("distribucion_horaria", "asignatura"),
      Field::getInstanceRequire("distribucion_horaria", "planificacion"),
    );
  }


}
