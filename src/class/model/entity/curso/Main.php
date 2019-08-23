<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class CursoEntityMain extends Entity {
  public $name = "curso";
  public $alias = "curs";
 
  public function getPk(){
    return Field::getInstanceRequire("curso", "id");
  }

  public function getFieldsNf(){
    return array(
      Field::getInstanceRequire("curso", "estado"),
      Field::getInstanceRequire("curso", "alta"),
      Field::getInstanceRequire("curso", "baja"),
    );
  }

  public function getFieldsMu(){
    return array(
      Field::getInstanceRequire("curso", "comision"),
      Field::getInstanceRequire("curso", "carga_horaria"),
    );
  }


}
