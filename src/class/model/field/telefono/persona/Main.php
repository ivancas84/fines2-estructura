<?php

require_once("class/model/Field.php");

class FieldTelefonoPersonaMain extends Field {

  public $type = "bigint";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "20";
  public $main = false;
  public $name = "persona";
  public $alias = "per";


  public function getEntity(){ return new TelefonoEntity; }

  public function getEntityRef(){ return new IdPersonaEntity; }


}
