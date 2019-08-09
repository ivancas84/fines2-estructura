<?php

require_once("class/model/Field.php");

class FieldDocumentacionRecibidaTomaMain extends Field {

  public $type = "bigint";
  public $fieldType = "_u";
  public $unique = true;
  public $notNull = true;
  public $default = false;
  public $length = "20";
  public $main = false;
    
  public static function name() { return  "toma"; }
  public static function alias() { return  "tom"; }


  public function getEntity(){ return new DocumentacionRecibidaEntity; }
  
  public function getEntityRef(){ return new TomaEntity; }


}
