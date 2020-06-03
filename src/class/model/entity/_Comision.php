<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _ComisionEntity extends Entity {
  public $name = "comision";
  public $alias = "comi";
 
  public function getPk(){
    return Field::getInstanceRequire("comision", "id");
  }

  public function getFieldsNf(){
    return array(
      Field::getInstanceRequire("comision", "turno"),
      Field::getInstanceRequire("comision", "division"),
      Field::getInstanceRequire("comision", "comentario"),
      Field::getInstanceRequire("comision", "autorizada"),
      Field::getInstanceRequire("comision", "apertura"),
      Field::getInstanceRequire("comision", "publicada"),
      Field::getInstanceRequire("comision", "observaciones"),
      Field::getInstanceRequire("comision", "alta"),
    );
  }

  public function getFieldsMu(){
    return array(
      Field::getInstanceRequire("comision", "sede"),
      Field::getInstanceRequire("comision", "modalidad"),
      Field::getInstanceRequire("comision", "planificacion"),
      Field::getInstanceRequire("comision", "comision_siguiente"),
      Field::getInstanceRequire("comision", "calendario"),
    );
  }


}
