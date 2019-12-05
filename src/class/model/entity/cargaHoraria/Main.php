<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class CargaHorariaEntityMain extends Entity {
  public $name = "carga_horaria";
  public $alias = "ch";
 
  public function getPk(){
    return Field::getInstanceRequire("carga_horaria", "id");
  }

  public function getFieldsNf(){
    return array(
      Field::getInstanceRequire("carga_horaria", "anio"),
      Field::getInstanceRequire("carga_horaria", "semestre"),
      Field::getInstanceRequire("carga_horaria", "horas_catedra"),
    );
  }

  public function getFieldsMu(){
    return array(
      Field::getInstanceRequire("carga_horaria", "plan"),
      Field::getInstanceRequire("carga_horaria", "asignatura"),
    );
  }


}
