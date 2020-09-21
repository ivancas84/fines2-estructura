<?php

require_once("class/model/Field.php");

class _FieldHorarioDia extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = true;
  public $default = null;
  public $length = "45";
  public $main = false;
  public $name = "dia";
  public $alias = "dia";


  public function getEntity(){ return $this->container->getEntity('horario'); }

  public function getEntityRef(){ return $this->container->getEntity('dia'); }


}
