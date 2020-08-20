<?php

require_once("class/model/Field.php");

class _FieldDesignacionSede extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = true;
  public $default = null;
  public $length = "45";
  public $main = false;
  public $name = "sede";
  public $alias = "sed";


  public function getEntity(){ return Entity::getInstanceRequire('designacion'); }

  public function getEntityRef(){ return Entity::getInstanceRequire('sede'); }


}
