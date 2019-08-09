<?php

require_once("class/model/Field.php");

class FieldDivisionNumeroMain extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = true;
  public $notNull = false;
  public $default = false;
  public $length = "45";
  public $main = false;
  public $name = "numero";
  public $alias = "num";


  public function getEntity(){ return new DivisionEntity; }


}
