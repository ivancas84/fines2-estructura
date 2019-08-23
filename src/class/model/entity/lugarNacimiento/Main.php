<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class LugarNacimientoEntityMain extends Entity {
  public $name = "lugar_nacimiento";
  public $alias = "ln";
 
  public function getPk(){
    return Field::getInstanceRequire("lugar_nacimiento", "id");
  }

  public function getFieldsNf(){
    return array(
      Field::getInstanceRequire("lugar_nacimiento", "ciudad"),
      Field::getInstanceRequire("lugar_nacimiento", "provincia"),
      Field::getInstanceRequire("lugar_nacimiento", "pais"),
      Field::getInstanceRequire("lugar_nacimiento", "alta"),
    );
  }


}
