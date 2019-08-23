<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class NotaEntityMain extends Entity {
  public $name = "nota";
  public $alias = "nota";
 
  public function getPk(){
    return Field::getInstanceRequire("nota", "id");
  }

  public function getFieldsNf(){
    return array(
      Field::getInstanceRequire("nota", "nota"),
      Field::getInstanceRequire("nota", "alta"),
    );
  }

  public function getFieldsMu(){
    return array(
      Field::getInstanceRequire("nota", "profesor"),
      Field::getInstanceRequire("nota", "curso"),
      Field::getInstanceRequire("nota", "alumno"),
    );
  }


}
