<?php

require_once("class/model/Field.php");

class _FieldCargaHorariaHorasCatedra extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "45";
  public $main = false;
  public $name = "horas_catedra";
  public $alias = "hc";


  public function getEntity(){ return new CargaHorariaEntity; }


}
