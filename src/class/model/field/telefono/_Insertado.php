<?php

require_once("class/model/Field.php");

class _FieldTelefonoInsertado extends Field {

  public $type = "timestamp";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = "CURRENT_TIMESTAMP";
  public $length = false;
  public $main = false;
  public $name = "insertado";
  public $alias = "ins";


  public function getEntity(){ return new TelefonoEntity; }


}
