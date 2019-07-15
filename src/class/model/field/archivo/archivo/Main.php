<?php

require_once("class/model/Field.php");

class FieldArchivoArchivoMain extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = "255";
  public $main = false;
    
  public static function name() { return  "archivo"; }
  public static function alias() { return  "arc"; }


  public function getEntity(){ return new ArchivoEntity; }


}
