<?php

require_once("class/model/Field.php");

class FieldNotaNotaMain extends Field {

  public $type = "bigint";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "20";
  public $main = false;
  public $name = "nota";
  public $alias = "noa";


  public function getEntity(){ return new NotaEntity; }


}
