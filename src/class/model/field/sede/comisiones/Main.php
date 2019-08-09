<?php

require_once("class/model/Field.php");

class FieldSedeComisionesMain extends Field {

  public $type = "int";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "10";
  public $main = false;
  public $name = "comisiones";
  public $alias = "com";


  public function getEntity(){ return new SedeEntity; }


}
