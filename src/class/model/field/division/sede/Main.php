<?php

require_once("class/model/Field.php");

class FieldDivisionSedeMain extends Field {

  public $type = "bigint";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "20";
  public $main = false;
  public $name = "sede";
  public $alias = "sed";


  public function getEntity(){ return new DivisionEntity; }

  public function getEntityRef(){ return new SedeEntity; }


}
