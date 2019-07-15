<?php

require_once("class/model/Entity.php");
require_once("config/entityClasses.php");

class LugarNacimientoEntityMain extends Entity {
  public $name = "lugar_nacimiento";
  public $alias = "ln";
 
  public function getPk(){
    return new FieldLugarNacimientoId;
  }

  public function getFieldsNf(){
    return array(
      new FieldLugarNacimientoCiudad,
      new FieldLugarNacimientoProvincia,
      new FieldLugarNacimientoPais,
      new FieldLugarNacimientoAlta,
    );
  }


}
