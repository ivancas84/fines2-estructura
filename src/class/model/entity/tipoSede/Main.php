<?php

require_once("class/model/Entity.php");
require_once("config/entityClasses.php");

class TipoSedeEntityMain extends Entity {
  public $name = "tipo_sede";
  public $alias = "ts";
 
  public function getPk(){
    return new FieldTipoSedeId;
  }

  public function getFieldsNf(){
    return array(
      new FieldTipoSedeDescripcion,
    );
  }


}
