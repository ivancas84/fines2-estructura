<?php

require_once("class/model/Field.php");

class FieldSedeAperturaMain extends Field {

  public $type = "tinyint";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "1";
  public $main = false;
  public $name = "apertura";
  public $alias = "ape";


  public function getEntity(){ return new SedeEntity; }


}
