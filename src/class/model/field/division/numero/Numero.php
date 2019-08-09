<?php

require_once("class/model/Field.php");

class FieldDivisionNumero extends Field  {
  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = true;
  public $notNull = true;
  public $default = false;
  public $length = "45";
  public $main = true;
  public $name = "numero";
  public $alias = "num";
  public $admin = false;
  public $db = false;


  public function getEntity(){ return new DivisionEntity; }


}
