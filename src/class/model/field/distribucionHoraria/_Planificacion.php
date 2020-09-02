<?php

require_once("class/model/Field.php");

class _FieldDistribucionHorariaPlanificacion extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = true;
  public $default = null;
  public $length = "45";
  public $main = false;
  public $name = "planificacion";
  public $alias = "pla";


  public function getEntity(){ return $this->container->getEntity('distribucion_horaria'); }

  public function getEntityRef(){ return $this->container->getEntity('planificacion'); }


}
