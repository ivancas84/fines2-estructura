<?php

require_once("class/model/Field.php");

class _FieldComisionPlanificacion extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = false;
  public $default = null;
  public $length = "45";
  public $main = false;
  public $name = "planificacion";
  public $alias = "pla";


  public function getEntity(){ return Entity::getInstanceRequire('comision'); }

  public function getEntityRef(){ return Entity::getInstanceRequire('planificacion'); }


}
