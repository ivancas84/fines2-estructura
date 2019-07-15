<?php

require_once("class/model/Entity.php");
require_once("config/entityClasses.php");

class UsuarioEntityMain extends Entity {
  public $name = "usuario";
  public $alias = "usua";
 
  public function getPk(){
    return new FieldUsuarioId;
  }

  public function getFieldsNf(){
    return array(
      new FieldUsuarioClave,
      new FieldUsuarioAlta,
      new FieldUsuarioBaja,
    );
  }

  public function getFieldsMu(){
    return array(
      new FieldUsuarioPersona,
    );
  }


}
