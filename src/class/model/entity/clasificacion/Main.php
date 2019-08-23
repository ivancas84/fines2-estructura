<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class ClasificacionEntityMain extends Entity {
  public $name = "clasificacion";
  public $alias = "clas";
 
  public function getPk(){
    return Field::getInstanceRequire("clasificacion", "id");
  }

  public function getFieldsNf(){
    return array(
      Field::getInstanceRequire("clasificacion", "nombre"),
    );
  }


}
