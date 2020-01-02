<?php

require_once("class/model/Field.php");

class FieldSedeCoordinador extends Field {

  public $type = "bigint";
  public $fieldType = "fk";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = "20";
  public $main = false;
  public $admin = false;
  public $name = "coordinador";
  public $alias = "coo";
  public $db = false;

  public function getEntity(){ return new SedeEntity; }

  public function getEntityRef(){ return new PersonaEntity; }


}
