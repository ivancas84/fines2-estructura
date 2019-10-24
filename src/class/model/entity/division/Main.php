<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class DivisionEntityMain extends Entity {
  public $name = "division";
  public $alias = "divi";
 
  public function getPk(){
    return Field::getInstanceRequire("division", "id");
  }

  public function getFieldsNf(){
    return array(
      Field::getInstanceRequire("division", "numero"),
      Field::getInstanceRequire("division", "serie"),
      Field::getInstanceRequire("division", "turno"),
    );
  }

  public function getFieldsMu(){
    return array(
      Field::getInstanceRequire("division", "plan"),
      Field::getInstanceRequire("division", "sede"),
    );
  }


}
