<?php

require_once("class/model/Entity.php");
require_once("config/entityClasses.php");

class CoordinadorEntityMain extends Entity {
  public $name = "coordinador";
  public $alias = "coor";
 
  public function getPk(){
    return new FieldCoordinadorId;
  }

  public function getFieldsNf(){
    return array(
      new FieldCoordinadorAlta,
      new FieldCoordinadorBaja,
    );
  }

  public function getFieldsMu(){
    return array(
      new FieldCoordinadorSede,
      new FieldCoordinadorPersona,
    );
  }


}
