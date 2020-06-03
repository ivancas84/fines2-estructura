<?php

require_once("class/model/Field.php");

class _FieldDiaDia extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = true;
  public $notNull = true;
  public $default = false;
  public $length = "9";
  public $main = false;
  public $name = "dia";
  public $alias = "dia";


  public function getEntity(){ return Entity::getInstanceRequire('dia'); }


}
