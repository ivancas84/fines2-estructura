<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _CursoEntity extends Entity {
  public $name = "curso";
  public $alias = "curs";
 
  public function getPk(){
    return Field::getInstanceRequire("curso", "id");
  }

  public function getFieldsNf(){
    return array(
      Field::getInstanceRequire("curso", "horas_catedra"),
      Field::getInstanceRequire("curso", "alta"),
    );
  }

  public function getFieldsMu(){
    return array(
      Field::getInstanceRequire("curso", "comision"),
      Field::getInstanceRequire("curso", "asignatura"),
    );
  }


}
