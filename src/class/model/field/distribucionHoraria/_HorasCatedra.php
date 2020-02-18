<?php

require_once("class/model/Field.php");

class _FieldDistribucionHorariaHorasCatedra extends Field {

  public $type = "int";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "10";
  public $main = false;
  public $name = "horas_catedra";
  public $alias = "hc";


  public function getEntity(){ return new DistribucionHorariaEntity; }


}
