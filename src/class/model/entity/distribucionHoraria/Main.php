<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class DistribucionHorariaEntityMain extends Entity {
  public $name = "distribucion_horaria";
  public $alias = "dh";
 
  public function getPk(){
    return Field::getInstanceRequire("distribucion_horaria", "id");
  }

  public function getFieldsNf(){
    return array(
      Field::getInstanceRequire("distribucion_horaria", "dia"),
      Field::getInstanceRequire("distribucion_horaria", "horas_catedra"),
    );
  }

  public function getFieldsMu(){
    return array(
      Field::getInstanceRequire("distribucion_horaria", "carga_horaria"),
    );
  }


}
