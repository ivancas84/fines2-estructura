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
      Field::getInstanceRequire("persona", "nombres"),
      Field::getInstanceRequire("persona", "apellidos"),
      Field::getInstanceRequire("persona", "fecha_nacimiento"),
      Field::getInstanceRequire("persona", "numero_documento"),
      Field::getInstanceRequire("persona", "cuil"),
      Field::getInstanceRequire("persona", "genero"),
      Field::getInstanceRequire("persona", "apodo"),
      Field::getInstanceRequire("persona", "alta"),
    );
  }

  public function getFieldsMu(){
    return array(
      Field::getInstanceRequire("persona", "domicilio"),
    );
  }


}
