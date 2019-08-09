<?php

require_once("class/model/Field.php");

class FieldDiaDiaMain extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "9";
  public $main = false;
  public $name = "dia";
  public $alias = "dia";


  public function getEntity(){ return new DiaEntity; }


}
