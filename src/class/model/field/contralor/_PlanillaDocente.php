<?php

require_once("class/model/Field.php");

class _FieldContralorPlanillaDocente extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "45";
  public $main = false;
  public $name = "planilla_docente";
  public $alias = "pd";


  public function getEntity(){ return Entity::getInstanceRequire('contralor'); }

  public function getEntityRef(){ return Entity::getInstanceRequire('contralor'); }


}
