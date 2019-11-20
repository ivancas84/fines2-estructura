<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class CentroEducativoEntityMain extends Entity {
  public $name = "centro_educativo";
  public $alias = "ce";
 
  public function getPk(){
    return Field::getInstanceRequire("centro_educativo", "id");
  }

  public function getFieldsNf(){
    return array(
      Field::getInstanceRequire("centro_educativo", "nombre"),
      Field::getInstanceRequire("centro_educativo", "cue"),
    );
  }

  public function getFieldsMu(){
    return array(
      Field::getInstanceRequire("centro_educativo", "domicilio"),
    );
  }


}
