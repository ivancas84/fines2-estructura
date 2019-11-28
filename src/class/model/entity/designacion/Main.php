<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class DesignacionEntityMain extends Entity {
  public $name = "designacion";
  public $alias = "desi";
 
  public function getPk(){
    return Field::getInstanceRequire("designacion", "id");
  }

  public function getFieldsNf(){
    return array(
      Field::getInstanceRequire("designacion", "alta"),
      Field::getInstanceRequire("designacion", "baja"),
    );
  }

  public function getFieldsMu(){
    return array(
      Field::getInstanceRequire("designacion", "cargo"),
      Field::getInstanceRequire("designacion", "persona"),
      Field::getInstanceRequire("designacion", "sede"),
    );
  }


}
