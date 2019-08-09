<?php

require_once("class/model/Field.php");

class FieldDocumentacionRecibidaAsistenciaMain extends Field {

  public $type = "tinyint";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "1";
  public $main = false;
    
  public static function name() { return  "asistencia"; }
  public static function alias() { return  "asi"; }


  public function getEntity(){ return new DocumentacionRecibidaEntity; }


}
