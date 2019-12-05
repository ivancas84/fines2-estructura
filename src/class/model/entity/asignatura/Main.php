<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class AsignaturaEntityMain extends Entity {
  public $name = "asignatura";
  public $alias = "asig";
 
  public function getPk(){
    return Field::getInstanceRequire("asignatura", "id");
  }

  public function getFieldsNf(){
    return array(
      Field::getInstanceRequire("asignatura", "nombre"),
      Field::getInstanceRequire("asignatura", "formacion"),
      Field::getInstanceRequire("asignatura", "clasificacion"),
      Field::getInstanceRequire("asignatura", "codigo"),
      Field::getInstanceRequire("asignatura", "perfil"),
    );
  }


}
