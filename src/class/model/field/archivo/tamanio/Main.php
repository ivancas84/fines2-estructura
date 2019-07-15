<?php

require_once("class/model/Field.php");

class FieldArchivoTamanioMain extends Field {

  public $type = "bigint";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = "20";
  public $main = false;
    
  public static function name() { return  "tamanio"; }
  public static function alias() { return  "tam"; }


  public function getEntity(){ return new ArchivoEntity; }


}
