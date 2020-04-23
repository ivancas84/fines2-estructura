<?php

require_once("class/model/Field.php");

class _FieldDistribucionHorariaAnio extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "45";
  public $main = false;
  public $name = "anio";
  public $alias = "ani";


  public function getEntity(){ return new DistribucionHorariaEntity; }


}