<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _DomicilioEntity extends Entity {
  public $name = "domicilio";
  public $alias = "domi";
 
  public function getPk(){
    return Field::getInstanceRequire("domicilio", "id");
  }

  public function getFieldsNf(){
    return array(
      Field::getInstanceRequire("domicilio", "calle"),
      Field::getInstanceRequire("domicilio", "entre"),
      Field::getInstanceRequire("domicilio", "numero"),
      Field::getInstanceRequire("domicilio", "piso"),
      Field::getInstanceRequire("domicilio", "departamento"),
      Field::getInstanceRequire("domicilio", "barrio"),
      Field::getInstanceRequire("domicilio", "localidad"),
    );
  }


}
