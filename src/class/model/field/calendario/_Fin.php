<?php

require_once("class/model/Field.php");

class _FieldCalendarioFin extends Field {

  public $type = "date";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = null;
  public $length = false;
  public $main = false;
  public $name = "fin";
  public $alias = "fin";


  public function getEntity(){ return Entity::getInstanceRequire('calendario'); }


}
