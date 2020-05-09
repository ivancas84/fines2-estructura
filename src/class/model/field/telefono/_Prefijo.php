<?php

require_once("class/model/Field.php");

class _FieldTelefonoPrefijo extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = "45";
  public $main = false;
  public $name = "prefijo";
  public $alias = "pre";


  public function getEntity(){ return new TelefonoEntity; }


}