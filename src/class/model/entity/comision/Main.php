<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class ComisionEntityMain extends Entity {
  public $name = "comision";
  public $alias = "comi";
 
  public function getPk(){
    return Field::getInstanceRequire("comision", "id");
  }

  public function getFieldsNf(){
    return array(
      Field::getInstanceRequire("comision", "anio"),
      Field::getInstanceRequire("comision", "semestre"),
      Field::getInstanceRequire("comision", "observaciones"),
      Field::getInstanceRequire("comision", "fecha"),
      Field::getInstanceRequire("comision", "alta"),
      Field::getInstanceRequire("comision", "baja"),
      Field::getInstanceRequire("comision", "usuario"),
      Field::getInstanceRequire("comision", "comentario"),
      Field::getInstanceRequire("comision", "autorizada"),
      Field::getInstanceRequire("comision", "apertura"),
      Field::getInstanceRequire("comision", "publicar"),
      Field::getInstanceRequire("comision", "fecha_anio"),
      Field::getInstanceRequire("comision", "feche_semestre"),
    );
  }

  public function getFieldsMu(){
    return array(
      Field::getInstanceRequire("comision", "comision_siguiente"),
      Field::getInstanceRequire("comision", "division"),
    );
  }


}
