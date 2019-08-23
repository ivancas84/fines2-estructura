<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class PermisoEntityMain extends Entity {
  public $name = "permiso";
  public $alias = "perm";
 
  public function getPk(){
    return Field::getInstanceRequire("permiso", "id");
  }

  public function getFieldsNf(){
    return array(
      Field::getInstanceRequire("permiso", "alta"),
      Field::getInstanceRequire("permiso", "baja"),
    );
  }

  public function getFieldsMu(){
    return array(
      Field::getInstanceRequire("permiso", "rol"),
      Field::getInstanceRequire("permiso", "persona"),
    );
  }


}
