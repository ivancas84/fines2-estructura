<?php

require_once("class/model/Field.php");

class _FieldTomaPlanillaDocente extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = false;
  public $default = null;
  public $length = "45";
  public $main = false;
  public $name = "planilla_docente";
  public $alias = "pd";


  public function getEntity(){ return $this->container->getEntity('toma'); }

  public function getEntityRef(){ return $this->container->getEntity('planilla_docente'); }


}
