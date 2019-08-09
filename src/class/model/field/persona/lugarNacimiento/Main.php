<?php

require_once("class/model/Field.php");

class FieldPersonaLugarNacimientoMain extends Field {

  public $type = "bigint";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = "20";
  public $main = false;
  public $name = "lugar_nacimiento";
  public $alias = "ln";


  public function getEntity(){ return new PersonaEntity; }

  public function getEntityRef(){ return new LugarNacimientoEntity; }


}
