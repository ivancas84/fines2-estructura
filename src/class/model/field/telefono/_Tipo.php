<?php

require_once("class/model/Field.php");

class _FieldTelefonoTipo extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = "45";
  public $main = false;
  public $name = "tipo";
  public $alias = "tip";


  public function getEntity(){ return new TelefonoEntity; }


}