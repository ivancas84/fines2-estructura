<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _ContralorEntity extends Entity {
  public $name = "contralor";
  public $alias = "cont";
 
  public function getPk(){
    return Field::getInstanceRequire("contralor", "id");
  }

  public function getFieldsNf(){
    return array(
      Field::getInstanceRequire("contralor", "fecha_contralor"),
      Field::getInstanceRequire("contralor", "fecha_consejo"),
      Field::getInstanceRequire("contralor", "insertado"),
    );
  }

  public function getFieldsMu(){
    return array(
      Field::getInstanceRequire("contralor", "planilla_docente"),
    );
  }


}
