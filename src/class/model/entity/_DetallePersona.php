<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _DetallePersonaEntity extends Entity {
  public $name = "detalle_persona";
  public $alias = "dp";
 
  public function getPk(){
    return Field::getInstanceRequire("detalle_persona", "id");
  }

  public function getFieldsNf(){
    return array(
      Field::getInstanceRequire("detalle_persona", "descripcion"),
      Field::getInstanceRequire("detalle_persona", "creado"),
    );
  }

  public function getFieldsMu(){
    return array(
      Field::getInstanceRequire("detalle_persona", "archivo"),
      Field::getInstanceRequire("detalle_persona", "persona"),
    );
  }


}
