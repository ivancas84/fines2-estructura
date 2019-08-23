<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class TomaEntityMain extends Entity {
  public $name = "toma";
  public $alias = "toma";
 
  public function getPk(){
    return Field::getInstanceRequire("toma", "id");
  }

  public function getFieldsNf(){
    return array(
      Field::getInstanceRequire("toma", "fecha_toma"),
      Field::getInstanceRequire("toma", "fecha_inicio"),
      Field::getInstanceRequire("toma", "fecha_fin"),
      Field::getInstanceRequire("toma", "fecha_entrada_contralor"),
      Field::getInstanceRequire("toma", "estado"),
      Field::getInstanceRequire("toma", "observaciones"),
      Field::getInstanceRequire("toma", "comentario_contralor"),
      Field::getInstanceRequire("toma", "alta"),
      Field::getInstanceRequire("toma", "tipo_movimiento"),
      Field::getInstanceRequire("toma", "estado_contralor"),
    );
  }

  public function getFieldsMu(){
    return array(
      Field::getInstanceRequire("toma", "curso"),
      Field::getInstanceRequire("toma", "profesor"),
      Field::getInstanceRequire("toma", "reemplaza"),
    );
  }


}
