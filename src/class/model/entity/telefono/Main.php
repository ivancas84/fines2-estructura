<?php

require_once("class/model/Entity.php");
require_once("config/entityClasses.php");

class TelefonoEntityMain extends Entity {
  public $name = "telefono";
  public $alias = "tele";
 
  public function getPk(){
    return new FieldTelefonoId;
  }

  public function getFieldsNf(){
    return array(
      new FieldTelefonoPrefijo,
      new FieldTelefonoNumero,
      new FieldTelefonoTipo,
      new FieldTelefonoAlta,
      new FieldTelefonoBaja,
    );
  }

  public function getFieldsMu(){
    return array(
      new FieldTelefonoPersona,
    );
  }


}
