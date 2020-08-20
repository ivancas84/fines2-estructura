<?php

require_once("class/model/Field.php");

class _FieldDistribucionHorariaDia extends Field {

  public $type = "int";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = null;
  public $length = "10";
  public $main = false;
  public $name = "dia";
  public $alias = "dia";


  public function getEntity(){ return Entity::getInstanceRequire('distribucion_horaria'); }


}
