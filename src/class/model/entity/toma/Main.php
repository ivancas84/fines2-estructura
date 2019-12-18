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
      Field::getInstanceRequire("toma", "fecha_contralor"),
      Field::getInstanceRequire("toma", "fecha_consejo"),
      Field::getInstanceRequire("toma", "estado"),
      Field::getInstanceRequire("toma", "observaciones"),
      Field::getInstanceRequire("toma", "comentario"),
      Field::getInstanceRequire("toma", "tipo_movimiento"),
      Field::getInstanceRequire("toma", "estado_contralor"),
      Field::getInstanceRequire("toma", "alta"),
    );
  }

  public function getFieldsMu(){
    return array(
      Field::getInstanceRequire("toma", "curso"),
      Field::getInstanceRequire("toma", "docente"),
      Field::getInstanceRequire("toma", "reemplazo"),
    );
  }


}
