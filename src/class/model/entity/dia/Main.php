<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class DiaEntityMain extends Entity {
  public $name = "dia";
  public $alias = "dia";
 
  public function getPk(){
    return Field::getInstanceRequire("dia", "id");
  }

  public function getFieldsNf(){
    return array(
      Field::getInstanceRequire("dia", "numero"),
      Field::getInstanceRequire("dia", "dia"),
    );
  }


}
