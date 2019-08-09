<?php

require_once("class/model/Field.php");

class FieldDocumentacionRecibidaIdMain extends Field {

  public $type = "bigint";
  public $fieldType = "pk";
  public $unique = true;
  public $notNull = true;
  public $default = false;
  public $length = "19";
  public $main = true;
    
  public static function name() { return  "id"; }
  public static function alias() { return  "id"; }


  public function getEntity(){ return new DocumentacionRecibidaEntity; }


}
