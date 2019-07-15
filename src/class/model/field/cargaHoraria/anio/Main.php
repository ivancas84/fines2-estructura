<?php

require_once("class/model/Field.php");

class FieldCargaHorariaAnioMain extends Field {

  public $type = "int";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "10";
  public $main = false;
  public $name = "anio";
  public $alias = "ani";


  public function getEntity(){ return new CargaHorariaEntity; }


}
