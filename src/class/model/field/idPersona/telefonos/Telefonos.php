<?php

require_once("class/model/Field.php");

class FieldIdPersonaTelefonos extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = "255";
  public $main = false;
  public $admin = false;
  public $name = "telefonos";
  public $alias = "tel";
  public $db = false;

  public function getEntity(){ return new IdPersonaEntity; }


}
