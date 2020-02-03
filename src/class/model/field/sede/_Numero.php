<?php

require_once("class/model/Field.php");

class _FieldSedeNumero extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "45";
  public $main = false;
  public $name = "numero";
  public $alias = "num";


  public function getEntity(){ return new SedeEntity; }


}
