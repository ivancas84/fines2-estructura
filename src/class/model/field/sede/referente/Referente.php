<?php

require_once("class/model/Field.php");

class FieldSedeReferente extends Field {

  public $type = "bigint";
  public $fieldType = "fk";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = "20";
  public $main = false;
  public $admin = false;
  public $name = "referente";
  public $alias = "ref";
  public $db = false;

  public function getEntity(){ return new SedeEntity; }

  public function getEntityRef(){ return new IdPersonaEntity; }


}
