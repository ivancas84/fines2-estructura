<?php

require_once("class/model/Field.php");

class FieldArchivoNombreMain extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "255";
  public $main = false;
    
  public static function name() { return  "nombre"; }
  public static function alias() { return  "nom"; }


  public function getEntity(){ return new ArchivoEntity; }


}
