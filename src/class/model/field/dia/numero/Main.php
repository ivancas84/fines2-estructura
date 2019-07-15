<?php

require_once("class/model/Field.php");

class FieldDiaNumeroMain extends Field {

  public $type = "smallint";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "1";
  public $main = false;
  public $name = "numero";
  public $alias = "num";


  public function getEntity(){ return new DiaEntity; }


}
