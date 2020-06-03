<?php

require_once("class/model/Field.php");

class _FieldComisionModalidad extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "45";
  public $main = false;
  public $name = "modalidad";
  public $alias = "moa";


  public function getEntity(){ return Entity::getInstanceRequire('comision'); }

  public function getEntityRef(){ return Entity::getInstanceRequire('comision'); }


}
