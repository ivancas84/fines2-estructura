<?php

require_once("class/model/Field.php");

class FieldPersonaIdPersonaMain extends Field {

  public $type = "bigint";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "20";
  public $main = false;
  public $name = "id_persona";
  public $alias = "ip";


  public function getEntity(){ return new PersonaEntity; }

  public function getEntityRef(){ return new IdPersonaEntity; }


}
