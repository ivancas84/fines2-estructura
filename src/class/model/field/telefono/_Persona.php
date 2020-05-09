<?php

require_once("class/model/Field.php");

class _FieldTelefonoPersona extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "45";
  public $main = false;
  public $name = "persona";
  public $alias = "per";


  public function getEntity(){ return new TelefonoEntity; }

  public function getEntityRef(){ return new PersonaEntity; }


}