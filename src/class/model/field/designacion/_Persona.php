<?php

require_once("class/model/Field.php");

class _FieldDesignacionPersona extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = true;
  public $default = null;
  public $length = "45";
  public $main = false;
  public $name = "persona";
  public $alias = "per";


  public function getEntity(){ return Entity::getInstanceRequire('designacion'); }

  public function getEntityRef(){ return Entity::getInstanceRequire('persona'); }


}
