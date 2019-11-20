<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class SedeEntityMain extends Entity {
  public $name = "sede";
  public $alias = "sede";
 
  public function getPk(){
    return Field::getInstanceRequire("sede", "id");
  }

  public function getFieldsNf(){
    return array(
      Field::getInstanceRequire("sede", "numero"),
      Field::getInstanceRequire("sede", "nombre"),
      Field::getInstanceRequire("sede", "observaciones"),
      Field::getInstanceRequire("sede", "alta"),
      Field::getInstanceRequire("sede", "baja"),
    );
  }

  public function getFieldsMu(){
    return array(
      Field::getInstanceRequire("sede", "domicilio"),
      Field::getInstanceRequire("sede", "tipo_sede"),
      Field::getInstanceRequire("sede", "centro_educativo"),
    );
  }


}
