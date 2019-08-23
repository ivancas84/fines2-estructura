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
      Field::getInstanceRequire("sede", "organizacion"),
      Field::getInstanceRequire("sede", "observaciones"),
      Field::getInstanceRequire("sede", "tipo"),
      Field::getInstanceRequire("sede", "alta"),
      Field::getInstanceRequire("sede", "baja"),
      Field::getInstanceRequire("sede", "usuario"),
    );
  }

  public function getFieldsMu(){
    return array(
      Field::getInstanceRequire("sede", "dependencia"),
      Field::getInstanceRequire("sede", "tipo_sede"),
    );
  }

  public function getFields_U(){
    return array(
      Field::getInstanceRequire("sede", "domicilio"),
    );
  }


}
