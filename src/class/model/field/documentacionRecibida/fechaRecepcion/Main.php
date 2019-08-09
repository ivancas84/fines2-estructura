<?php

require_once("class/model/Field.php");

class FieldDocumentacionRecibidaFechaRecepcionMain extends Field {

  public $type = "date";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = false;
  public $main = false;
    
  public static function name() { return  "fecha_recepcion"; }
  public static function alias() { return  "fr"; }


  public function getEntity(){ return new DocumentacionRecibidaEntity; }


}
