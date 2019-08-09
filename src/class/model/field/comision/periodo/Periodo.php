<?php

require_once("class/model/Field.php");

class FieldComisionPeriodo extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = 5;
  public $main = false;
  public $name = "periodo";
  public $alias = "pe";
  public $db = false;
  public $admin = false;


  public function getEntity(){ return new ComisionEntity; }


}
