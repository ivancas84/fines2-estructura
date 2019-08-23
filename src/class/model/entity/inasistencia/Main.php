<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class InasistenciaEntityMain extends Entity {
  public $name = "inasistencia";
  public $alias = "inas";
 
  public function getPk(){
    return Field::getInstanceRequire("inasistencia", "id");
  }

  public function getFieldsNf(){
    return array(
      Field::getInstanceRequire("inasistencia", "fecha_desde"),
      Field::getInstanceRequire("inasistencia", "fecha_hasta"),
      Field::getInstanceRequire("inasistencia", "modulos_semanales"),
      Field::getInstanceRequire("inasistencia", "modulos_mensuales"),
      Field::getInstanceRequire("inasistencia", "articulo"),
      Field::getInstanceRequire("inasistencia", "inciso"),
      Field::getInstanceRequire("inasistencia", "observaciones"),
    );
  }

  public function getFieldsMu(){
    return array(
      Field::getInstanceRequire("inasistencia", "toma"),
    );
  }


}
