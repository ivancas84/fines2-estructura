<?php

require_once("class/model/Field.php");

class FieldNotaCrecMain extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = "45";
  public $main = false;
    
  public static function name() { return  "crec"; }
  public static function alias() { return  "cre"; }


  public function getEntity(){ return new NotaEntity; }


}
