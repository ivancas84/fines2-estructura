<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _DesignacionEntity extends Entity {
  public $name = "designacion";
  public $alias = "desi";
 
  public function getPk(){
    return Field::getInstanceRequire("designacion", "id");
  }

  public function getFieldsNf(){
    return array(
      Field::getInstanceRequire("designacion", "desde"),
      Field::getInstanceRequire("designacion", "hasta"),
      Field::getInstanceRequire("designacion", "alta"),
    );
  }

  public function getFieldsMu(){
    return array(
      Field::getInstanceRequire("designacion", "cargo"),
      Field::getInstanceRequire("designacion", "sede"),
      Field::getInstanceRequire("designacion", "persona"),
    );
  }


}
