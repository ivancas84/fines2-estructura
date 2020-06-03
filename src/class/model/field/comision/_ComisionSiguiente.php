<?php

require_once("class/model/Field.php");

class _FieldComisionComisionSiguiente extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = "45";
  public $main = false;
  public $name = "comision_siguiente";
  public $alias = "cs";


  public function getEntity(){ return Entity::getInstanceRequire('comision'); }

  public function getEntityRef(){ return Entity::getInstanceRequire('comision'); }


}
