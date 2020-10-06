<?php

require_once("class/model/Field.php");

class _FieldAsignacionPlanillaDocenteToma extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = true;
  public $default = null;
  public $length = "45";
  public $main = false;
  public $name = "toma";
  public $alias = "tom";


  public function getEntity(){ return $this->container->getEntity('asignacion_planilla_docente'); }

  public function getEntityRef(){ return $this->container->getEntity('toma'); }


}
