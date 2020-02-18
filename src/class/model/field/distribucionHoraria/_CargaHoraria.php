<?php

require_once("class/model/Field.php");

class _FieldDistribucionHorariaCargaHoraria extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "45";
  public $main = false;
  public $name = "carga_horaria";
  public $alias = "ch";


  public function getEntity(){ return new DistribucionHorariaEntity; }

  public function getEntityRef(){ return new CargaHorariaEntity; }


}
