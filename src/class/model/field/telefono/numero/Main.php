<?php

require_once("class/model/Field.php");

class FieldTelefonoNumeroMain extends Field {

  public $type = "bigint";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "20";
  public $main = false;
  public $name = "numero";
  public $alias = "num";


  public function getEntity(){ return new TelefonoEntity; }


}
