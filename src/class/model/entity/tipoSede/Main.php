<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class TipoSedeEntityMain extends Entity {
  public $name = "tipo_sede";
  public $alias = "ts";
 
  public function getPk(){
    return Field::getInstanceRequire("tipo_sede", "id");
  }

  public function getFieldsNf(){
    return array(
      Field::getInstanceRequire("tipo_sede", "descripcion"),
    );
  }


}
