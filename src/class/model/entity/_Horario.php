<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _HorarioEntity extends Entity {
  public $name = "horario";
  public $alias = "hora";
 
  public function getPk(){
    return Field::getInstanceRequire("horario", "id");
  }

  public function getFieldsNf(){
    return array(
      Field::getInstanceRequire("horario", "hora_inicio"),
      Field::getInstanceRequire("horario", "hora_fin"),
    );
  }

  public function getFieldsMu(){
    return array(
      Field::getInstanceRequire("horario", "curso"),
      Field::getInstanceRequire("horario", "dia"),
    );
  }


}
