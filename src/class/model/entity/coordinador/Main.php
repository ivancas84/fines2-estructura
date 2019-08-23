<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class CoordinadorEntityMain extends Entity {
  public $name = "coordinador";
  public $alias = "coor";
 
  public function getPk(){
    return Field::getInstanceRequire("coordinador", "id");
  }

  public function getFieldsNf(){
    return array(
      Field::getInstanceRequire("coordinador", "alta"),
      Field::getInstanceRequire("coordinador", "baja"),
    );
  }

  public function getFieldsMu(){
    return array(
      Field::getInstanceRequire("coordinador", "sede"),
      Field::getInstanceRequire("coordinador", "persona"),
    );
  }


}
