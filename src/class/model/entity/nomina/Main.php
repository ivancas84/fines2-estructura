<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class NominaEntityMain extends Entity {
  public $name = "nomina";
  public $alias = "nomi";
 
  public function getPk(){
    return Field::getInstanceRequire("nomina", "id");
  }

  public function getFieldsNf(){
    return array(
      Field::getInstanceRequire("nomina", "alta"),
      Field::getInstanceRequire("nomina", "activo"),
    );
  }

  public function getFieldsMu(){
    return array(
      Field::getInstanceRequire("nomina", "division"),
      Field::getInstanceRequire("nomina", "persona"),
    );
  }


}
