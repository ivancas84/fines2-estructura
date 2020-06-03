<?php

require_once("class/model/Field.php");

class _FieldSedeCentroEducativo extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = "45";
  public $main = false;
  public $name = "centro_educativo";
  public $alias = "ce";


  public function getEntity(){ return Entity::getInstanceRequire('sede'); }

  public function getEntityRef(){ return Entity::getInstanceRequire('sede'); }


}
