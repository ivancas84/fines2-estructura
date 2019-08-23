<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class IdPersonaEntityMain extends Entity {
  public $name = "id_persona";
  public $alias = "ip";
 
  public function getPk(){
    return Field::getInstanceRequire("id_persona", "id");
  }

  public function getFieldsNf(){
    return array(
      Field::getInstanceRequire("id_persona", "nombres"),
      Field::getInstanceRequire("id_persona", "apellidos"),
      Field::getInstanceRequire("id_persona", "sobrenombre"),
      Field::getInstanceRequire("id_persona", "fecha_nacimiento"),
      Field::getInstanceRequire("id_persona", "tipo_documento"),
      Field::getInstanceRequire("id_persona", "numero_documento"),
      Field::getInstanceRequire("id_persona", "email"),
      Field::getInstanceRequire("id_persona", "genero"),
      Field::getInstanceRequire("id_persona", "cuil"),
      Field::getInstanceRequire("id_persona", "alta"),
    );
  }


}
