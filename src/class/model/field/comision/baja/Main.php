<?php

require_once("class/model/Field.php");

class FieldComisionBajaMain extends Field {

  public $type = "timestamp";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = false;
  public $main = false;
  public $name = "baja";
  public $alias = "baj";


  public function getEntity(){ return new ComisionEntity; }


}
