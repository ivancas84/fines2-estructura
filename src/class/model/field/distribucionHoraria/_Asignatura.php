<?php

require_once("class/model/Field.php");

class _FieldDistribucionHorariaAsignatura extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "45";
  public $main = false;
  public $name = "asignatura";
  public $alias = "asi";


  public function getEntity(){ return Entity::getInstanceRequire('distribucion_horaria'); }

  public function getEntityRef(){ return Entity::getInstanceRequire('asignatura'); }


}
