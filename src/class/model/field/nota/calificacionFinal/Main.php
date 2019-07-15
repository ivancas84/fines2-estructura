<?php

require_once("class/model/Field.php");

class FieldNotaCalificacionFinalMain extends Field {

  public $type = "int";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = "10";
  public $main = false;
    
  public static function name() { return  "calificacion_final"; }
  public static function alias() { return  "cf"; }


  public function getEntity(){ return new NotaEntity; }


}
