<?php

require_once("class/model/Field.php");

class FieldDocumentacionRecibidaTemasTratadosMain extends Field {

  public $type = "tinyint";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "1";
  public $main = false;
    
  public static function name() { return  "temas_tratados"; }
  public static function alias() { return  "tt"; }


  public function getEntity(){ return new DocumentacionRecibidaEntity; }


}
