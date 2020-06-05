<?php

require_once("class/model/Field.php");

class _FieldComisionCalendario extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = "45";
  public $main = false;
  public $name = "calendario";
  public $alias = "cal";


  public function getEntity(){ return Entity::getInstanceRequire('comision'); }

  public function getEntityRef(){ return Entity::getInstanceRequire('calendario'); }


}
