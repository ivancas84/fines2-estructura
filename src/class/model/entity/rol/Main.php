<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class RolEntityMain extends Entity {
  public $name = "rol";
  public $alias = "rol";
 
  public function getPk(){
    return Field::getInstanceRequire("rol", "id");
  }

  public function getFieldsNf(){
    return array(
      Field::getInstanceRequire("rol", "descripcion"),
      Field::getInstanceRequire("rol", "detalle"),
    );
  }


}
