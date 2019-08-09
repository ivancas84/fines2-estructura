<?php

require_once("class/model/Field.php");

class FieldNotaNota3Main extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = "45";
  public $main = false;
    
  public static function name() { return  "nota3"; }
  public static function alias() { return  "noc"; }


  public function getEntity(){ return new NotaEntity; }


}
