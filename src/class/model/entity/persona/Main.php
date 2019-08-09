<?php

require_once("class/model/Entity.php");
require_once("config/entityClasses.php");

class PersonaEntityMain extends Entity {
  public $name = "persona";
  public $alias = "pers";
 
  public function getPk(){
    return new FieldPersonaId;
  }

  public function getFieldsNf(){
    return array(
      new FieldPersonaAlta,
      new FieldPersonaBaja,
    );
  }

  public function getFieldsMu(){
    return array(
      new FieldPersonaLugarNacimiento,
      new FieldPersonaIdPersona,
      new FieldPersonaDomicilio,
    );
  }


}
