<?php

require_once("class/model/Field.php");

class FieldDocumentacionRecibidaCalificacionesMain extends Field {

  public $type = "tinyint";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "1";
  public $main = false;
    
  public static function name() { return  "calificaciones"; }
  public static function alias() { return  "cal"; }


  public function getEntity(){ return new DocumentacionRecibidaEntity; }


}
