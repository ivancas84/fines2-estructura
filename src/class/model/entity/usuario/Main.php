<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class UsuarioEntityMain extends Entity {
  public $name = "usuario";
  public $alias = "usua";
 
  public function getPk(){
    return Field::getInstanceRequire("usuario", "id");
  }

  public function getFieldsNf(){
    return array(
      Field::getInstanceRequire("usuario", "clave"),
      Field::getInstanceRequire("usuario", "alta"),
      Field::getInstanceRequire("usuario", "baja"),
    );
  }

  public function getFieldsMu(){
    return array(
      Field::getInstanceRequire("usuario", "persona"),
    );
  }


}
