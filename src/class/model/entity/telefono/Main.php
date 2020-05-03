<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class TelefonoEntityMain extends Entity {
  public $name = "telefono";
  public $alias = "tele";
 
  public function getPk(){
    return Field::getInstanceRequire("telefono", "id");
  }

  public function getFieldsNf(){
    return array(
      Field::getInstanceRequire("telefono", "tipo"),
      Field::getInstanceRequire("telefono", "prefijo"),
      Field::getInstanceRequire("telefono", "numero"),
      Field::getInstanceRequire("telefono", "insertado"),
      Field::getInstanceRequire("telefono", "eliminado"),
    );
  }

  public function getFieldsMu(){
    return array(
      Field::getInstanceRequire("telefono", "persona"),
    );
  }


}
