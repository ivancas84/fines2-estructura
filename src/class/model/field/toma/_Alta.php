<?php

require_once("class/model/Field.php");

class _FieldTomaAlta extends Field {

  public $type = "timestamp";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = "CURRENT_TIMESTAMP";
  public $length = false;
  public $main = false;
  public $name = "alta";
  public $alias = "alt";


  public function getEntity(){ return new TomaEntity; }


}
