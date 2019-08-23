<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class PersonaEntityMain extends Entity {
  public $name = "persona";
  public $alias = "pers";
 
  public function getPk(){
    return Field::getInstanceRequire("persona", "id");
  }

  public function getFieldsNf(){
    return array(
      Field::getInstanceRequire("persona", "alta"),
      Field::getInstanceRequire("persona", "baja"),
    );
  }

  public function getFieldsMu(){
    return array(
      Field::getInstanceRequire("persona", "lugar_nacimiento"),
      Field::getInstanceRequire("persona", "id_persona"),
      Field::getInstanceRequire("persona", "domicilio"),
    );
  }


}
