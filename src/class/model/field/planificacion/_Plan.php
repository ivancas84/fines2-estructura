<?php

require_once("class/model/Field.php");

class _FieldPlanificacionPlan extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = true;
  public $default = null;
  public $length = "45";
  public $main = false;
  public $name = "plan";
  public $alias = "plb";


  public function getEntity(){ return Entity::getInstanceRequire('planificacion'); }

  public function getEntityRef(){ return Entity::getInstanceRequire('plan'); }


}
