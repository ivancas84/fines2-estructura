<?php

require_once("class/model/Field.php");

class FieldNomina2DivisionMain extends Field {

  public $type = "bigint";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "20";
  public $main = false;
    
  public static function name() { return  "division"; }
  public static function alias() { return  "div"; }


  public function getEntity(){ return new Nomina2Entity; }
  
  public function getEntityRef(){ return new DivisionEntity; }


}
