<?php

require_once("class/model/Field.php");

class FieldComisionDivisionMain extends Field {

  public $type = "bigint";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "20";
  public $main = false;
  public $name = "division";
  public $alias = "dia";


  public function getEntity(){ return new ComisionEntity; }

  public function getEntityRef(){ return new DivisionEntity; }


}
