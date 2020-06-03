<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _EmailEntity extends Entity {
  public $name = "email";
  public $alias = "emai";
 
  public function getPk(){
    return Field::getInstanceRequire("email", "id");
  }

  public function getFieldsNf(){
    return array(
      Field::getInstanceRequire("email", "email"),
      Field::getInstanceRequire("email", "verificado"),
      Field::getInstanceRequire("email", "insertado"),
      Field::getInstanceRequire("email", "eliminado"),
    );
  }

  public function getFieldsMu(){
    return array(
      Field::getInstanceRequire("email", "persona"),
    );
  }


}
