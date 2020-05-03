<?php

require_once("class/model/Field.php");

class _FieldTomaEstado extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = "45";
  public $main = false;
  public $name = "estado";
  public $alias = "est";


  public function getEntity(){ return new TomaEntity; }


}
