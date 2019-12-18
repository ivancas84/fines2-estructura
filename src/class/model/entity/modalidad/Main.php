<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class ModalidadEntityMain extends Entity {
  public $name = "modalidad";
  public $alias = "moda";
 
  public function getPk(){
    return Field::getInstanceRequire("modalidad", "id");
  }

  public function getFieldsNf(){
    return array(
      Field::getInstanceRequire("modalidad", "nombre"),
    );
  }


}
