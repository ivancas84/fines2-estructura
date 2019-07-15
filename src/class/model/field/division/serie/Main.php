<?php

require_once("class/model/Field.php");

class FieldDivisionSerieMain extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "45";
  public $main = false;
  public $name = "serie";
  public $alias = "ser";


  public function getEntity(){ return new DivisionEntity; }


}
