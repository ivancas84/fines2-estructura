<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _CalendarioEntity extends Entity {
  public $name = "calendario";
  public $alias = "cale";
 
  public function getPk(){
    return Field::getInstanceRequire("calendario", "id");
  }

  public function getFieldsNf(){
    return array(
      Field::getInstanceRequire("calendario", "inicio"),
      Field::getInstanceRequire("calendario", "fin"),
      Field::getInstanceRequire("calendario", "anio"),
      Field::getInstanceRequire("calendario", "semestre"),
      Field::getInstanceRequire("calendario", "insertado"),
    );
  }


}
